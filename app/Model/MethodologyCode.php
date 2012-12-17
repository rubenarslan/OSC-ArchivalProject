<?php
class MethodologyCode extends AppModel {
	public $belongsTo = 'Test';
	function beforeSave($options = array()) {
		 debug($this->data);
	}
}
