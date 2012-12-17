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
	public function getReplicable($id = NULL) {
		if($id !==NULL AND !is_numeric($id)) die('NUMBER!');
		if($id === NULL) $where = '';
		else $where = "WHERE studies.id != $id";
		$all_studies = $this->query("SELECT studies.id,studies.name,papers.first_author,papers.year,papers.title,users.username FROM studies
		LEFT JOIN
			codedpapers
			ON codedpapers.id = studies.codedpaper_id
		LEFT JOIN papers
			ON papers.id = codedpapers.paper_id
		LEFT JOIN users
			ON users.id = codedpapers.user_id
		".$where);

		if(count($all_studies)> 0) {
			$study_names = array_combine(
					Set::extract($all_studies,"{n}.studies.id"), 
					Set::format($all_studies,"{0} ({1}): {2} – {3} coded by {4}", array(
						"{n}.papers.first_author",
						"{n}.papers.year",
						"{n}.papers.title",
						"{n}.studies.name",
						"{n}.users.username")
					)
			);
		} else {
			$study_names = array();
		}
		
		return $study_names;
	}
}