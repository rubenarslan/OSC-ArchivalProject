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
#		echo urldecode($freeform)."<br>";
		$freeform = urldecode($freeform);
		$url = 'http://search.labs.crossref.org/dois?q='.rawurlencode($freeform);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application; style=apa'));
#		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$matches = curl_exec_follow($ch);
	#	print($matches);
		$json = json_decode( $matches , true);
		if($json[0]['score'] < 2) {
			echo $freeform;
			echo "<br>";
			echo 'No good matches. Copy the DOI and go back if the right one is in here, otherwise try
			Google Scholar or another service<br>';
			pr($json);
		}
		
		return array_merge(array('APA' => $freeform),$this->fetchByDOI($json[0]['doi']));
	}
	public function fetchPubmedIDByDOI($DOI = null) {
		$params = array(
			'db' => 'pubmed',
			'tool' => 'homemadePHPquery',
			'email' => Configure::read('Pubmed.email'),
			'term' => $DOI,
			'usehistory' => 'y',
			'retmax' => 1
		);
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?' . http_build_query($params);
		$xml = file_get_contents($url);
#		var_dump($xml);
		$dom = new DomDocument();
		$dom->loadXml($xml);
		if($dom->getElementsByTagName('Id')->length==0)
			return null;
		else
			return (int) $dom->getElementsByTagName('Id')->item(0)->nodeValue;
	}
	public function fetchAbstractByPubmedID($id = null) {
		$params = array(
			'db' => 'pubmed',
			'tool' => 'homemadePHPquery',
			'email' => Configure::read('Pubmed.email'),
			'id' => $id,
			'retmode' => 'xml',
		);
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
	public function fetchCitationCountByPubmedID($id = null) {
		$params = array(
			'db' => 'pubmed',
			'tool' => 'homemadePHPquery',
			'email' => Configure::read('Pubmed.email'),
			'id' => $id,
			'retmode' => 'xml',
			'linkname' => 'pubmed_pmc_refs',
			'cmd' => 'neighbor',
		);
		$url = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/elink.fcgi?' . http_build_query($params);
		$xml = file_get_contents($url);
#		var_dump($xml);
		$dom = new DomDocument();
		$dom->loadXml($xml);
		$cites = (int) $dom->getElementsByTagName('Id')->length - 1; # one ID is the article itself
		
		return $cites;
	}
	public function fetchByDOI($DOI = null) {
		$ch = curl_init('http://dx.doi.org/'.$DOI);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/bibliography; style=apa'));
#		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$apa_ref = curl_exec_follow($ch);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/citeproc+json"));
		$json = curl_exec_follow($ch); # get associative array
		curl_close($ch);
		if(substr($json,0,2)=='{"') {
			$json = json_decode( trim( $json, '"' ), true);
			$json['journal'] = $json['container-title'];
			$json['year'] = $json['issued']['date-parts'][0][0];
			$json['first_author'] = $json['author'][0]['family'] . ", " . $json['author'][0]['given'];
			unset($json['container-title']); unset($json['issued']); unset($json['author']); unset($json['editor']);
		}
		else $json = array('DOI' => $DOI);
		
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
		if(count($json)>1) { // if the metadata request was successful (I just check whether I got JSON back)
			$json['pubmed_id'] = $this->fetchPubmedIDByDOI($DOI);
			if(is_numeric($json['pubmed_id'])) {
				$json['abstract'] = $this->fetchAbstractByPubmedID($json['pubmed_id']);
				$json['pubmed_nr_of_citations'] = $this->fetchCitationCountByPubmedID($json['pubmed_id']);
			}
			$json['APA'] = $apa_ref;
		}
		return $json;
	}
}