<?php
class Effect extends AppModel {
	public $belongsTo = 'Study';
	public $hasMany = array('Test' => array('dependent'=>TRUE));
	public $validate = array(
		'prior_hypothesis' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true,
        ),
		'novel_effect' => array(
	        'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true,
	    ),
    );
}

