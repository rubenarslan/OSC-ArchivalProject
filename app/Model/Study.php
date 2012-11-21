<?php
class Study extends AppModel {
	public $belongsTo = 'Codedpaper';
	public $hasMany = 'Effect';
}

