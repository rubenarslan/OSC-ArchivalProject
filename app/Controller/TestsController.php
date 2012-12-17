<?php
App::uses('AppController', 'Controller');
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

	public function edit($id = null) {
		$this->Test->id = $id;
		if (!$this->Test->exists()) {
			throw new NotFoundException(__('Invalid test'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Test->saveAssociated($this->request->data)) {
				
				debug($this->request->data);
				$this->Session->setFlash(__('The test has been saved'));
#				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The test could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Test->read(null, $id);
			debug($this->request->data);
		}
		$studies = $this->Test->Study->find('list');
		$methodologyCodes = $this->Test->MethodologyCode->find('list');
		$independentVariables = $this->Test->IndependentVariable->find('list');
		$this->set(compact('studies', 'methodologyCodes','independentVariables'));
	}
}
