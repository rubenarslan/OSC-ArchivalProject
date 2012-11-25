<?php
class CodedpapersController extends AppController {
	function beforeFilter() {
		parent::beforeFilter();
	}
	function isAuthorized($user = null) {	
		parent::isAuthorized($user); # allow admins to do anything
			
		$codedpaper_id = $this->request->params['pass'][0];
		$this->Codedpaper->id = $codedpaper_id;
		if (!$this->Codedpaper->exists()) {
		    throw new NotFoundException('Invalid paper');
		}
		else {
			$allowed = $this->Codedpaper->find('first',array("recursive" => -1));
			if( $allowed['Codedpaper']['user_id'] == $this->Auth->user('id')) { # is this the creator of the coded paper
				return true;
			}
		}
		return false;
	}
	public function code ($id = NULL) {
		
		
		$this->Codedpaper->id = $id;
		
		# todo: add auth for paper-user
		
		if (!$this->Codedpaper->exists()) {
		    throw new NotFoundException('Invalid paper');
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
	}
	public function morestudies () {
	}
	public function moreeffects () {
	}
	public function moretests () {
	}
}
