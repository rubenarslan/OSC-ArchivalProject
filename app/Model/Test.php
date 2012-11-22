<?php
class Test extends AppModel {
	public $belongsTo = 'Effect';
	public $validate = array(
        'inferential_test_statistic_value' => array(
            'decimal' => array(
                'rule'     => array('decimal',NULL,"/^\d+(\.\d+)?$/"),
                'required' => true,
                'message'  => 'Numbers only',
            )
        ),
        'N_used' => array(
            'rule'    => "naturalNumber",
            'required' => true,
            'message' => 'Must be a natural number'
        ),
	    'data_points_excluded' => array(
	       'rule'    => "naturalNumber",
           'required' => true,
	       'message' => 'Must be a natural number'
	    ),
        'analytic_design_code' => array(
            'rule'       => 'alphaNumeric',
            'message'    => 'Must be alphanumeric.',
            'required' => true
        )
    );
}

