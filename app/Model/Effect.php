<?php
class Effect extends AppModel {
	public $belongsTo = 'Study';
	public $hasMany = 'Test';
}

