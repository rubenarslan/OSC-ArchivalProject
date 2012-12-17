<?php
class IndependentVariable extends AppModel {
	public $belongsTo = 'Test';
    function beforeSave($options = array()) {
		 debug($this->data);
	}
}

