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
		
		$newcodedpaper['paper_id'] = $id;
		$newcodedpaper['user_id'] = $this->Auth->user('id');
		$this->Codedpaper->create(); # have to call this for save to work, but apparently it doesn't confound the find query.
		
		$preexisting = $this->Codedpaper->find('first',array('conditions' => $newcodedpaper));		
		if( $preexisting ) { # use the user and paper id to see whether this has been coded by this user already, if so, send him there
			$this->Session->setFlash(__('You can\'t code the same paper twice.'));
			$cid = $preexisting['Codedpaper']['id'];
			$this->redirect('code/'.$cid);
			exit;
		}
		else if( $this->Codedpaper->save($newcodedpaper) ) { # if not, create a new one, save it and send him there
			$this->Session->setFlash(__('A new paper can be coded now.'));
			$cid = $this->Codedpaper->read(null);
			$cid = $cid['Codedpaper']['id'];
			$this->redirect('code/'.$cid);
		} else {
			$this->Session->setFlash(__('The new coded paper could not be saved. Please, try again.'));
		}
	}
	public function code ($id = NULL) {
		
		
		$this->Codedpaper->id = $id;
		
		# todo: add auth for paper-user
		
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
		else {
			$this->request->data = $this->Codedpaper->find('first',array("recursive" => 3));
		}
		$this->set('replicable_studies', $this->Codedpaper->find('all',array(
			"recursive" => 1,
			'fields' => array('id')
		))); # todo: get all replicable studies and label them meaningfully
		
	}
	public function morestudies () {
	}
	public function moreeffects () {
	}
	public function moretests () {
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
