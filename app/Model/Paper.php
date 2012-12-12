<?php
App::uses('AppModel', 'Model');
/**
 * Paper Model
 *
 * @property Codedpaper $Codedpaper
 */
class Paper extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $actsAs = array('Containable');
	public $hasMany = array(
		'Codedpaper' => array(
			'className' => 'Codedpaper',
			'foreignKey' => 'paper_id',
			'dependent' => false,
		)
	);
	
	public function getMultipleCodings ($id = null) {
		$mult = $this->find('first', # GET THAT PAPER
			array(
				"conditions" => array(
					'Paper.id' => $id,
					),
				'fields' => 'id',
				'contain' => array(
					'Codedpaper' => array( 
						'fields' => array('id','completed','user_id','paper_id'),
						'User' => array('fields' => 'username'),
						'conditions' => array( 'completed' => true ) 
						),
				) 
			));
		$cps = Set::extract($mult,'Codedpaper.{n}.id');
		$usernames = Set::extract($mult,'Codedpaper.{n}.User.username');
		$mult = @array_combine($cps,$usernames); # @ because I don't have PHP 4 on the server.
		if(!$mult) $mult = array();
		return $mult;
	}
	public function fetchByFreeForm($freeform = null) {
		# http://search.labs.crossref.org/dois?q=Carberry%2C+Josiah.+%E2%80%9CToward+a+Unified+Theory+of+High-Energy+Metaphysics%3A+Silly+String+Theory.%E2%80%9D+Journal+of+Psychoceramics+5.11+%282008%29%3A+1-3.#
		$ch = curl_init('http://search.labs.crossref.org/dois?q='.urlencode($freeform));
#		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application; style=apa']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$matches = curl_exec($ch);
	#	print($matches);
		$json = json_decode( $matches , true);

		return array_merge(array('APA' => $freeform),$this->fetchByDOI($json[0]['doi']));
	}
	public function fetchByDOI($DOI = null) {
		$ch = curl_init('http://dx.doi.org/'.$DOI);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: text/bibliography; style=apa']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$apa_ref = curl_exec($ch);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/citeproc+json"]);
		$json = curl_exec($ch); # get associative array
		curl_close($ch);

		$json = json_decode( trim( $json, '"' ), true);
		$json['journal'] = $json['container-title'];
		$json['year'] = $json['issued']['date-parts'][0][0];
		$json['first_author'] = $json['author'][0]['family'] . ", " . $json['author'][0]['given'];
		unset($json['container-title']); unset($json['issued']); unset($json['author']); unset($json['editor']);
		
		$consumerkey = Configure::read('Mendeley.consumerkey');
		$ch_mendeley = curl_init("http://api.mendeley.com/oapi/documents/details/". 
		urlencode(urlencode($DOI)). "/?type=doi&consumer_key=" . $consumerkey);
		curl_setopt($ch_mendeley, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch_mendeley, CURLOPT_RETURNTRANSFER, true);
		$mendeley_json = curl_exec($ch_mendeley);
		$mendeley_json = json_decode( $mendeley_json, true);

		if(count($mendeley_json)>5) {
			$chars_altered = strlen($json['title']) - similar_text($mendeley_json['title'],$json['title'], $similarity);
			if($chars_altered !== 0 AND $similarity<50) debug('Mendeley and dx.doi.org disagree about the article title.');
			$json['readers'] = $mendeley_json['stats']['readers'];
			$json['abstract'] = $mendeley_json['abstract'];
		}
		
		return array_merge(array('APA' => $apa_ref),$json);
	}
}