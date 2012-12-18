<?php
App::uses('AppController', 'Controller');
/**
 * JoinedCodedpapers Controller
 *
 * @property JoinedCodedpaper $JoinedCodedpaper
 */
class JoinedCodedpapersController extends AppController {

	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;
		return false;
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->JoinedCodedpaper->recursive = 0;
		$this->set('joinedCodedpapers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->JoinedCodedpaper->id = $id;
		if (!$this->JoinedCodedpaper->exists()) {
			throw new NotFoundException(__('Invalid joined codedpaper'));
		}
		$this->set('joinedCodedpaper', $this->JoinedCodedpaper->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JoinedCodedpaper->create();
			if ($this->JoinedCodedpaper->save($this->request->data)) {
				$this->Session->setFlash(__('The joined codedpaper has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The joined codedpaper could not be saved. Please, try again.'));
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
		$this->JoinedCodedpaper->id = $id;
		if (!$this->JoinedCodedpaper->exists()) {
			throw new NotFoundException(__('Invalid joined codedpaper'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->JoinedCodedpaper->save($this->request->data)) {
				$this->Session->setFlash(__('The joined codedpaper has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The joined codedpaper could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->JoinedCodedpaper->read(null, $id);
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
		$this->JoinedCodedpaper->id = $id;
		if (!$this->JoinedCodedpaper->exists()) {
			throw new NotFoundException(__('Invalid joined codedpaper'));
		}
		if ($this->JoinedCodedpaper->delete()) {
			$this->Session->setFlash(__('Joined codedpaper deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Joined codedpaper was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
