<?php
class Codedpaper extends AppModel {
	public $belongsTo = array('User','Paper');
	public $hasMany = array(
		'Study' => array(
			"className" => 'Codedpaper',
			"foreign_key" => 'codedpaper_id'
		);
}

