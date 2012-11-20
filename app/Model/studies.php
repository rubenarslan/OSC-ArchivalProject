<?php
class study extends AppModel {
	public $belongsTo = 'paper';
	public $hasMany = 'effect';
}

