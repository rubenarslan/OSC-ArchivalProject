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
	public function createDummy ($study_id, $sstart, $estart = 0, $cascade = true) {
		$this->create();
		$data = array('Effect' => array('study_id' => $study_id));
		if($dummyentry = $this->save($data,$validate=FALSE)) {
			if($cascade) {
				return $this->Test->createDummy($study_id,$dummyentry['Effect']['id'],$sstart,$estart,0);
			}
			else return array('Study' => array($sstart => 
					array('id' => $study_id, 
					'Effect'=> array($estart => 
						$dummyentry['Effect']
					))
				)); # stupid acrobatics...
		}
		else { debug($this->validationErrors); die(); }
	}
}

