<?php
App::uses('AppController', 'Controller');
class TestsController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;

		$req_action = $this->request->params['action'];

		$test_id = $this->request->params['pass'][0];
		$this->Test->id = $test_id;
		if (!$this->Test->exists()) {
		    throw new NotFoundException('Invalid test');
		}
		else {
			$allowed = $this->Test->find('first',array(
				"recursive" => 3,
				"conditions" => array(
					'Test.id' => $test_id
					)
				));
			if( $allowed['Effect']['Study']['Codedpaper']['user_id'] == $this->Auth->user('id')) { # is this the creator of the coded paper
				return true;
			}
		}
		return false;
	}
	public function delete($id = null) {
		$this->Test->id = $id;
		if (!$this->request->is('ajax')) $ajax = TRUE; else $ajax = FALSE;
		if (!$this->Test->exists()) {
			throw new NotFoundException(__('Invalid Test'));
		}
		if ($this->Test->delete()) {
			if($ajax) {
				$this->Session->setFlash(__('Test deleted'));
				$this->redirect("/codedpapers/index_mine");
			} else {
				echo 'Test deleted';
				exit;
			}
		}
		$this->Session->setFlash(__('Test was not deleted'));
		$this->redirect("/codedpapers/index_mine");
	}
}
