<?php
class CodedpapersController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;
		
		$req_action = $this->request->params['action'];
		if(in_array($req_action, array('view', 'add', 'index_mine', 'index','moretests','moreeffects','morestudies','compare'))) return true; # viewing and adding is allowed to all users. comparing, indexing and adding empty stuff too.
		

		$codedpaper_id = $this->request->params['pass'][0];
		$this->Codedpaper->id = $codedpaper_id;
		if (!$this->Codedpaper->exists()) {
		    throw new NotFoundException('Invalid coded paper');
		}
		else {
			$allowed = $this->Codedpaper->find('first',array(
				"recursive" => -1,
				"conditions" => array(
					'user_id' => $this->Auth->user('id'),
					'id' => $codedpaper_id
					)
				));
			if( $allowed['Codedpaper']['user_id'] == $this->Auth->user('id')) { # is this the creator of the coded paper
				return true;
			}
		}
		return false;
	}
	public function add ($id = NULL) {
		
		$this->Codedpaper->create();
		$this->Codedpaper->Paper->id = $id;
		
		if (!$this->Codedpaper->Paper->exists()) {
		    throw new NotFoundException('Invalid paper');
		}
		
		$insertcp = $this->Codedpaper->createDummy($id,$this->Auth->user('id'));
		$this->Session->setFlash($insertcp['message']);
		$cid = $insertcp['cid'];
		if($cid !== null)
			$this->redirect('code/'.$cid);
		else
			$this->redirect('index/');
		exit;
	}
	public function code ($id = NULL) {
		$this->Codedpaper->id = $id;
				
		if (!$this->Codedpaper->exists()) {
		    throw new NotFoundException('Invalid coded paper');
		}
		if (!$this->request->is('get')) { # if it was posted or ajaxed			
			if($this->Codedpaper->saveAssociated($this->request->data, array("deep" => TRUE)	)) {
#				if($this->request->is('ajax')) { # commented this out, because I'm reloading the form again
#					echo 'Study saved.';
#					exit;
#				} 
#				else {
#					$this->Session->setFlash('Study Saved!');
#				}
			}
			else {
				$this->Session->setFlash("Could not save.");
			}
		}
		### get data again (if I submitted abstract and title as hidden fields, I wouldn't need to do it)
		$this->request->data = $this->Codedpaper->findDeep($id);
		#http://book.cakephp.org/2.0/en/core-utility-libraries/set.html#Set::flatten
#		$all_codedpaper_studies = $this->Codedpaper->Study->find('all',array(
#			"recursive" => 0,
#			'fields' => array('Codedpaper.id')
#		));
		$all_studies = $this->Codedpaper->Study->find('all',array(
			"recursive" => 0,
			'fields' => array('Codedpaper.id','Study.id','Study.name')
		));
#		debug($all_studies);
#		$all_studies = array_flip(Set::flatten($all_studies) );
#		$all_codedpapers = array_diff($all_studies,Set::flatten($all_codedpaper_studies));
#	$all_studies = $this->Codedpaper->Paper->find('threaded',array(
#		"recursive" => 2,
#		'fields' => array('Study.id')
#	));
#		debug(Set::flatten(Set::extract($all_studies,"{n}.Codedpaper.id")));
		$study_names = Set::flatten(Set::extract($all_studies,"Codedpaper/Study/name"));
#		$study_names = Set::format($all_studies, '{0}: {1}', array("{n}.Codedpaper.id", 'Codedpaper/Study/name'));
		
		$all_studies = Set::flatten(Set::extract($all_studies,"Codedpaper/Study/id"));
#		debug($all_studies); debug($study_names);
		
		$all_studies = array_merge(array(''=>''),array_combine($all_studies, $study_names));
		$this->set('replicable_studies', $all_studies); # todo: get all replicable studies and label them meaningfully	
	}
	public function morestudies () {
		$all_studies = $this->Codedpaper->Study->find('all',array(
			"recursive" => 0,
			'fields' => array('Codedpaper.id','Study.id','Study.name')
		));
		$study_names = Set::flatten(Set::extract($all_studies,"Codedpaper/Study/name"));
		$all_studies = Set::flatten(Set::extract($all_studies,"Codedpaper/Study/id"));
		$all_studies = array_combine($all_studies, $study_names);
		$this->set('replicable_studies', $all_studies);
			
		$this->request->data = $this->Codedpaper->Study->createDummy($this->request->query['codedpaper_id'], $this->request->query['sstart']);
	}
	public function moreeffects () {
		$this->request->data = $this->Codedpaper->Study->Effect->createDummy($this->request->query['study_id'], $this->request->query['s'], $this->request->query['estart']);
	}
	public function moretests () {
		$this->request->data = $this->Codedpaper->Study->Effect->Test->createDummy($this->request->query['study_id'], $this->request->query['effect_id'], $this->request->query['s'], $this->request->query['e'], $this->request->query['tstart']);
	}
	public function compare ($id1 = NULL, $id2 = NULL) {
		if (!$this->Codedpaper->exists($id1)) 
		    throw new NotFoundException('First paper does not exist.');
		if (!$this->Codedpaper->exists($id2)) 
		    throw new NotFoundException('Second paper does not exist.');
		if($this->Codedpaper->field('paper_id',array('id' => $id1))!== $this->Codedpaper->field('paper_id',array('id' => $id2)))
			throw new NotFoundException('These are codings of two different papers.');
		if($this->Codedpaper->field('completed',array('id' => $id1))==false OR $this->Codedpaper->field('completed',array('id' => $id2))==false)
			throw new NotFoundException('One of these papers is not yet marked as completely coded.');
		
		$comparison = $this->Codedpaper->compare($id1,$id2);
		$this->set('c1',$comparison[0]);
		$this->set('c2',$comparison[1]);
	}
	public function view($id = null) {
		## todo: make a view that's basically equivalent to the form but is read only / can't be submitted
		die('View function not yet implemented. Will do this when the coding form is finished.');
		$this->Codedpaper->id = $id;
		if (!$this->Codedpaper->exists()) {
			throw new NotFoundException(__('Invalid coded paper'));
		}
		$this->set('codedpaper', $this->Codedpaper->read(null, $id));
	}
	public function index_mine() {
		$this->set('codedpapers', $this->Codedpaper->find('all',
			array('conditions' => 
				array('user_id' => $this->Auth->user('id')),
				'recursive' => 1
			)
		));
	}
	public function index() {
		$this->set('codedpapers', $this->Codedpaper->find('all',
			array(
				'recursive' => 1
			)
		));
	}
}
