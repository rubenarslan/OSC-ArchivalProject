<?php
class paper extends AppModel {
	public $belongsTo = array('user','paper');
	public $hasMany = 'study';
}

