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
				"recursive" => 2,
				"conditions" => array(
					'Paper.id' => $id
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
		
		return array_merge(array('APA' => $apa_ref),$json);
		
		#curl -LH "Accept: applicationdx.doi.org/10.1038/nrd842
#		return $apa_ref;
#		curl -LH "Accept: text/bibliography; style=apa" http://dx.doi.org/10.1038/nrd842
#		$piped = file_get_contents(	);
#		debug($piped);
		#http://www.crossref.org/openurl/?id=doi:10.3998/3336451.0009.101&noredirect=true&pid=rubenarslan@gmail.com&format=unixref
	}
}