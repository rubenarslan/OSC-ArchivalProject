<?php
App::uses('AppController', 'Controller');
/**
 * Papers Controller
 *
 * @property Paper $Paper
 */
class PapersController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;
		
		$req_action = $this->request->params['action'];
		if(in_array($req_action, array('view', 'index','find_multiple'))) return true; # viewing and indexing is allowed to all users
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
#		$ids = Set::flatten($this->Paper->find('all',array('fields'=>'Paper.id', 'recursive'=>-1) ));
#		$mult = $this->Paper->getMultipleCodings($ids);
#		$this->set('multipleCodings', $mult);
		
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
	public function byDoi($doi = null) {
		$doi = '10.1145/1323688.1323690';
		$url = 'http://www.mendeley.com/oapi/documents/details/' . urlencode(urlencode($doi)) . '/?type=doi&consumer_key=CONSUMER_KEY';
		$url = str_replace('CONSUMER_KEY', Configure::read('Mendeley.consumerkey'), $url);
		$json = $this->Mendeley->http($url, 'GET');
		debug($json);
		exit;
		
#		$this->Paper->fetchByDoi($doi);
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
