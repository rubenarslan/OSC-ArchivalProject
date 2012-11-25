<?php
App::uses('AppController', 'Controller');
/**
 * Papers Controller
 *
 * @property Paper $Paper
 */
class PapersController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		parent::isAuthorized($user); # allow admins to do anything

		$req_action = $this->request->params['action'];
		if(in_array($req_action, array('view', 'index'))) return true; # viewing and adding is allowed to all users
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paper->recursive = 0;
		$this->set('papers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Paper->id = $id;
		if (!$this->Paper->exists()) {
			throw new NotFoundException(__('Invalid paper'));
		}
		$this->set('paper', $this->Paper->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Paper->create();
			if ($this->Paper->save($this->request->data)) {
				$this->Session->setFlash(__('The paper has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paper could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Paper->id = $id;
		if (!$this->Paper->exists()) {
			throw new NotFoundException(__('Invalid paper'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Paper->save($this->request->data)) {
				$this->Session->setFlash(__('The paper has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The paper could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Paper->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Paper->id = $id;
		if (!$this->Paper->exists()) {
			throw new NotFoundException(__('Invalid paper'));
		}
		if ($this->Paper->delete()) {
			$this->Session->setFlash(__('Paper deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Paper was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
