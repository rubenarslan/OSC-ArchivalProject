<?php
class Test extends AppModel {
	public $belongsTo = 'Effect';
	public $validate = array(
		'analytic_design_code' => array(
			'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => true
        ),
		'methodology_codes' => array(
			'multiple' => array(
				'rule' => array('multiple',
					'in' => array("","BI","P","SR","I","BC"),
					),
				'required' => false,
				'allowEmpty' => true,
				)
#			'rule' => 'notEmpty',
#	        'required' => false,
#            'allowEmpty' => true
	    ),
		'independent_variables' => array(
	       	'rule' => 'notEmpty',
			'required' => true	,
            'allowEmpty' => true
	   ),
		'dependent_variables' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true
		),
		'other_variables' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true
		),
		'data_points_excluded' => array(
	       'rule'    => array("naturalNumber",true),
           'required' => true,
           'allowEmpty' => true,
	       'message' => 'Must be a natural number'
	    ),
		'reasons_for_exclusions' => array(
			'rule' => 'notEmpty',
			'required' => false,
            'allowEmpty' => true
		),
		'type_statistical_test' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true
		),
        'N_used' => array(
            'rule' => 'notEmpty',
			'rule'    => "naturalNumber",
            'required' => true,
            'allowEmpty' => true,
            'message' => 'Must be a natural number'
        ),
		'inferential_test_statistic' => array(
	        'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true,
		),
		'inferential_test_statistic_value' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
		),
	    'degrees_of_freedom' => array(
	        'rule'    => array("naturalNumber",true),
	        'required' => true,
            'allowEmpty' => true,
	        'message' => 'Must be a natural number'
	    ),
        'reported_significance_of_test' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
        ),
	    'computed_significance_of_test' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
	    'main_result_of_test' => array(
	        'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true,
	    ),
		'reported_effect_size' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
		'reported_effect_size' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
		'computed_effect_size' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
		'reported_statistical_power' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
		'computed_statistical_power' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => true,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
	    
    );
	public function createDummy ($study_id, $effect_id, $sstart, $estart, $tstart = 0) {
		$this->create();
		$data = array('Test' => array('effect_id' => $effect_id));
		if($dummyentry = $this->save($data,$validate=FALSE)) {
			return array('Study' => array($sstart => 
				array('id' => $study_id, 
				'Effect'=> array($estart => array('id' => $effect_id,
					'Test'=> array($tstart => $dummyentry['Test']
					))
				))
			)); # stupid acrobatics...
		}
		else { debug($this->validationErrors); die(); }
	}
}

