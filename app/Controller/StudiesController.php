<?php
class StudiesController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;
		
		$req_action = $this->request->params['action'];
	
		$study_id = $this->request->params['pass'][0];
		$this->Study->id = $study_id;
		if (!$this->Study->exists()) {
		    throw new NotFoundException('Invalid study');
		}
		else {
			$allowed = $this->Study->find('first',array(
				"recursive" => 1,
				"conditions" => array(
					'Codedpaper.user_id' => $this->Auth->user('id'),
					'Study.id' => $study_id
					)
				));
			if( $allowed['Codedpaper']['user_id'] == $this->Auth->user('id')) { # is this the creator of the coded paper
				return true;
			}
		}
		return false;
	}
	public function delete($id = null) {
		$this->Study->id = $id;
		if (!$this->request->is('ajax')) $ajax = TRUE; else $ajax = FALSE;
		
		if (!$this->Study->exists()) {
			throw new NotFoundException(__('Invalid study'));
		}
		if ($this->Study->delete()) {
			if($ajax) {
			    $this->Session->setFlash(__('Study deleted'));
			    $this->redirect("/codedpapers/index_mine");
			} else {
			    echo 'Study deleted';
				exit;
			}
		}
		$this->Session->setFlash(__('Study was not deleted'));
	    $this->redirect("/codedpapers/index_mine");
	}
}
