<?php
class Effect extends AppModel {
	public $belongsTo = 'Study';
	public $hasMany = 'Test';
	public $validate = array(
		'prior_hypothesis' => array(
#            'required' => true,
            #'allowEmpty' => false,
        ),
		'novel_effect' => array(
#	        'required' => true,
            #'allowEmpty' => false,
	    ),
    );
}

