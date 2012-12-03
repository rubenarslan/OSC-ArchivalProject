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
		return $mult;
	}
	public function fetchByDOI($doi = null) {
		$Paper = ClassRegistry::init('Mendeley');
		
		$url = 'http://www.mendeley.com/oapi/documents/details/' . urlencode(urlencode($doi)) . '/?type=doi&consumer_key=CONSUMER_KEY';
		$url = str_replace('CONSUMER_KEY', Configure::read('Mendeley.consumerkey'), $url);
		$json = $this->Mendeley->http($url, 'GET');
		debug($json);
	}
}