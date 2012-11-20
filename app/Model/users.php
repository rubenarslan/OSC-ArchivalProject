<?php
class user extends AppModel {
	public $hasMany = 'paper';
	public $displayField = 'name';
}

