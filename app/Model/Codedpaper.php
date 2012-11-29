<?php
class Codedpaper extends AppModel {
	public $belongsTo = array('User','Paper');
	public $hasMany = array('Study' => array('dependent'=>TRUE));
}

