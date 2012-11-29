<?php
class Study extends AppModel {
	public $belongsTo = 'Codedpaper';
	public $hasMany = array('Effect' => array('dependent'=>TRUE));
	public $validate = array(
		'replication_code' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true,
        ),
		'replicates_study_id' => array(
			'rule' => 'numeric',
			'required' => true,
            'allowEmpty' => true,	
	    ),
   );
}