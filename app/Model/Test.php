<?php
class Test extends AppModel {
	public $belongsTo = 'Effect';
	public $validate = array(
		'analytic_design_code' => array(
			'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false
        ),
		'methodology_codes' => array(
			'rule' => 'notEmpty',
	        'required' => true,
            'allowEmpty' => false
	    ),
		'independent_variables' => array(
	       	'rule' => 'notEmpty',
			'required' => true	,
            'allowEmpty' => false
	   ),
		'dependent_variables' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => false
		),
		'other_variables' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true
		),
		'data_points_excluded' => array(
	       'rule'    => "naturalNumber",
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
            'allowEmpty' => false
		),
        'N_used' => array(
            'rule' => 'notEmpty',
			'rule'    => "naturalNumber",
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Must be a natural number'
        ),
		'inferential_test_statistic' => array(
	        'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => false,
		),
		'inferential_test_statistic_value' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => false,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
		),
	    'degrees_of_freedom' => array(
	        'rule'    => "naturalNumber",
	        'required' => true,
            'allowEmpty' => false,
	        'message' => 'Must be a natural number'
	    ),
        'reported_significance_of_test' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => false,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
        ),
	    'computed_significance_of_test' => array(
		    'decimal' => array(
		        'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
		        'required' => true,
	            'allowEmpty' => false,
		        'message'  => 'Numbers only, decimals marked by dot.',
		    )
	    ),
	    'main_result_of_test' => array(
	        'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => false,
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
}

