<?php
class effect extends AppModel {
	public $belongsTo = 'study';
	public $hasMany = 'test';
}

