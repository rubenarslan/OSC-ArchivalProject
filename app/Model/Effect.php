<?php
class Effect extends AppModel {
	public $belongsTo = 'Study';
	public $hasMany = 'Test';
	public $validate = array(
		'prior_hypothesis' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => false,

        ),
		'novel_effect' => array(
	        'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => false,
	    ),
    );
}

