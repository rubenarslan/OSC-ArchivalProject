<?php
class CodedpapersController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;
		
		$req_action = $this->request->params['action'];
		if(in_array($req_action, array('view', 'add', 'index_mine', 'index','moretests','moreeffects','morestudies'))) return true; # viewing and adding is allowed to all users
		

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
		$this->Codedpaper->user_id = $this->Auth->user('id');
				
		if (!$this->Codedpaper->exists()) {
		    throw new NotFoundException('Invalid coded paper');
		}
		if (!$this->request->is('get')){ # if it was posted or ajaxed
			if($this->Codedpaper->saveAssociated($this->request->data, 
				array("deep" => TRUE)
				)) {
				$this->Session->setFlash('Study Saved!');
			}
			else {
				$this->Session->setFlash("Could not save.");
			}
		}
		else {  # fixme: for some reason, when I read the data right after saving it, it isn't displayed, I have to reload. how come..?
			$this->request->data = $this->Codedpaper->find('first', # get this user's paper
				array(
					"recursive" => 3,
					"conditions" => array(
						'user_id' => $this->Auth->user('id'),
						'Codedpaper.id' => $id
						)
				));
		}
		#http://book.cakephp.org/2.0/en/core-utility-libraries/set.html#Set::flatten
#		$all_codedpaper_studies = $this->Codedpaper->Study->find('all',array(
#			"recursive" => 0,
#			'fields' => array('Codedpaper.id')
#		));
		$all_studies = $this->Codedpaper->Study->find('all',array(
			"recursive" => 0,
			'fields' => array('Study.id')
		));
		$all_studies = array_flip(Set::flatten($all_studies) );
#		$all_codedpapers = array_diff($all_studies,Set::flatten($all_codedpaper_studies));
#	$all_studies = $this->Codedpaper->Paper->find('threaded',array(
#		"recursive" => 2,
#		'fields' => array('Study.id')
#	));
#		$all_studies = Set::classicExtract($all_studies,"{n}.Codedpaper.{n}.Paper.id");
#		$all_studies = Set::classicExtract($all_studies,"{n}.Codedpaper.{n}.Study.{n}.id");
		
		#$all_studies = array_combine(array_keys($all_studies), $all_studies);
		$this->set('replicable_studies', $all_studies); # todo: get all replicable studies and label them meaningfully
		
	}
	public function morestudies () {
		$all_studies = $this->Codedpaper->Study->find('all',array(
			"recursive" => 0,
			'fields' => array('Study.id')
		));
		$all_studies = array_flip(Set::flatten($all_studies) );
		$this->set('replicable_studies', $all_studies); # todo: get all replicable studies and label them meaningfully
		
		$this->request->data = $this->Codedpaper->Study->createDummy($this->request->query['codedpaper_id'], $this->request->query['sstart']);
	}
	public function moreeffects () {
		$this->request->data = $this->Codedpaper->Study->Effect->createDummy($this->request->query['study_id'], $this->request->query['s'], $this->request->query['estart']);
	}
	public function moretests () {
		$this->request->data = $this->Codedpaper->Study->Effect->Test->createDummy($this->request->query['study_id'], $this->request->query['effect_id'], $this->request->query['s'], $this->request->query['e'], $this->request->query['tstart']);
	}
	public function view($id = null) {
		## todo: make a view that's basically equivalent to the form but is read only / can't be submitted
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
