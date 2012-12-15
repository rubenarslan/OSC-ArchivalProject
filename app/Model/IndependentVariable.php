<?php
class IndependentVariable extends AppModel {
	public $belongsTo = 'Test';
	public $validate = array(
		'variable' => array(
			'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false
        ));
}

