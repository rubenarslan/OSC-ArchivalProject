<?php
class MethodologyCode extends AppModel {
	public $belongsTo = 'Test';
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
            'required' => false,
            'allowEmpty' => true
   ));
	function beforeSave($options = array()) {
		$test_id = $this->data['MethodologyCode']['test_id'];
		$meth_codes = $this->data['MethodologyCode']['methodology_code'];
		$this->data['MethodologyCode'] = array();
		for($i=0;$i<count($meth_codes);$i++) {
			$this->data['MethodologyCode'] = array('test_id' => $test_id, 'methodology_code' => $meth_codes[$i]);
		}
		 debug($this->data);
	}
}
