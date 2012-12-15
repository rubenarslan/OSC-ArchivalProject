<?php
class Study extends AppModel {
	public $belongsTo = 'Codedpaper';
	public $hasMany = array('Test' => array('dependent'=>TRUE));
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'required' => true,
            'allowEmpty' => true,
        ),
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
	public function createDummy ($codedpaper_id, $sstart = 0, $cascade=true) {
		$this->create();
		$data = array('Study' => array('codedpaper_id' => $codedpaper_id));
		if($dummyentry = $this->save($data,$validate=FALSE)) {
			if($cascade) {
				return $this->Test->createDummy($dummyentry['Study']['id'],$sstart,0);
			}
			else return array('Study' => array($sstart => $dummyentry['Study'])); # stupid acrobatics...
		}
		else { debug($this->validationErrors); die(); }
	}
}