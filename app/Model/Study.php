<?php
class Study extends AppModel {
	public $belongsTo = 'Codedpaper';
	public $hasMany = 'Effect';
	public $validate = array(
		'replication_code' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => false,
        ),
		'replicates_study_id' => array(
			'rule' => 'numeric',
			'required' => true,
            'allowEmpty' => true,	
	    ),
   );
}