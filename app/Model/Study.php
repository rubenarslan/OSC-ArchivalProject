<?php
class Study extends AppModel {
	public $belongsTo = 'Paper';
	public $hasMany = 'Effect';
}

