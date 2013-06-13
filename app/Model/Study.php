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
			'required' => false,
            'allowEmpty' => true,	
	    ),
		'replication_freetext' => array(
			'rule' => 'notEmpty',
			'required' => false,
	        'allowEmpty' => true,
	    ),
	
	);
	public function createDummy ($codedpaper_id, $sstart = 0, $cascade=true) {
		$this->create();
		$data = array('Study' => 
			array('codedpaper_id' => $codedpaper_id)
		);
		if($dummyentry = $this->save($data,$validate=FALSE)) {
			if($cascade) {
				return $this->Test->createDummy($dummyentry['Study'],$sstart,0);
			}
			else return array('Study' => array($sstart => $dummyentry['Study'])); # stupid acrobatics...
		}
		else { debug($this->validationErrors); die(); }
	}
	public function getReplicable($id = NULL) {
		if($id !==NULL AND !is_numeric($id)) die('NUMBER!');
		if($id === NULL) $where = '';
		else $where = "WHERE studies.codedpaper_id = ".((int)$id);
		$all_studies = $this->query("SELECT studies.id,studies.name,papers.first_author,papers.year,papers.title FROM studies
		LEFT JOIN
			codedpapers
			ON codedpapers.id = studies.codedpaper_id
		LEFT JOIN papers
			ON papers.id = codedpapers.paper_id
		".$where);

		if(count($all_studies)> 0) {
			$study_names = array_combine(
					array_merge((array)'', Set::extract($all_studies,"{n}.studies.id") ), 
					array_merge((array)'', Set::format($all_studies,"{3} ({0}, {1})", array(
						"{n}.papers.first_author",
						"{n}.papers.year",
						"{n}.papers.title",
						"{n}.studies.name")
					) )
			);
		} else {
			$study_names = array('' => '');
		}
		
		return $study_names;
	}
}