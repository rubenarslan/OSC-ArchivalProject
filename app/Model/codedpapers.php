<?php
class codedpaper extends AppModel {
	public $belongsTo = array('user','paper');
	public $hasMany = array(
		'study' => array(
			"foreign_key" => 'codedpaper_id'
		);
}

