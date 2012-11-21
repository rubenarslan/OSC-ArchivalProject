<?php
class Codedpaper extends AppModel {
	public $belongsTo = array('User','Paper');
	public $hasMany = 'Study';
}

