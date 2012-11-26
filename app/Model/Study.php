<?php
class Study extends AppModel {
	public $belongsTo = 'Codedpaper';
	public $hasMany = 'Effect';
	public $validate = array(
		'replication_code' => array(
#            'required' => true,
            #'allowEmpty' => false,
        ),
##		'replicates_study_id' => array(
#	    ),
    );
}

