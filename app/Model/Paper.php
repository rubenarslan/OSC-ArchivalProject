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
		$ch = curl_init('http://search.labs.crossref.org/dois?q='.urlencode($freeform));
#		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application; style=apa']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$matches = curl_exec($ch);
	#	print($matches);
		$json = json_decode( $matches , true);

		return array_merge(array('APA' => $freeform),$this->fetchByDOI($json[0]['doi']));
	}
	public function fetchAbstractByDOIpubmed($DOI = null, $email= 'rubenarslan@gmail.com') {
		$database = 'pubmed';
		$params = array(
			'db' => $database,
			'tool' => 'homemadePHPquery',
			'email' => $email,
			'term' => $DOI,
			'usehistory' => 'y',
			'retmax' => 1
		);
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?' . http_build_query($params);
		$xml = file_get_contents($url);
		$dom = new DomDocument();
		$dom->loadXml($xml);
		$id = (int) $dom->getElementsByTagName('Id')->item(0)->nodeValue;
		unset($params['term']); unset($params['usehistory']); unset($params['retmax']);
		$params['id'] = $id;
		$params['retmode'] = 'xml';
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?' . http_build_query($params);
		$xml = file_get_contents($url);
#		debug($xml);
		$dom = new DomDocument();
	 	$dom->loadXML($xml);
#	var_dump($dom);
		if( $dom->getElementsByTagName('AbstractText')->length > 0 )
			$abstract = $dom->getElementsByTagName('AbstractText') ->item(0)->nodeValue;
		else $abstract = '';
		
		return $abstract;
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
		
		/*
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
		*/
		$json['abstract'] = $this->fetchAbstractByDOIpubmed($DOI);
		
		return array_merge(array('APA' => $apa_ref),$json);
	}
}