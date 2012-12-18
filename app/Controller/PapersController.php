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
	public function APAbyDOI($DOI = null) {
		$DOI = $this->request->query['DOI'];
		pr ($this->Paper->fetchByDOI($DOI));
		exit;
	}
	public function DOIbyAPA($APA = null) {
		$APA = $this->request->query['APA'];
		pr ($this->Paper->fetchByFreeForm($APA));
		exit;
	}
	public function pubmeddoi($DOI = null) {
		$DOI = $this->request->query['DOI'];
		pr ($this->Paper->fetchByDOIpubmed($DOI));
		exit;
	}
	# todo: improve inline help in coding form
	# todo: calculate p-values based on test statistic

	# todo: more gamificiation, i.e. Levels, Badges, Points, Progress Bars, a leaderboard, ...?
		# related: make it easy for disoriented coders to find someone at an intermediate level (lots of badges) to ask for advice
	# todo: roles and supervision. maybe the easiest would be if students choose their supervisor at sign up. is it sufficient for our purposes right now if all "managers" have access to all users and can simply check at what institution they are? otherwise I'll regret not going for fully-fledged ACLs.. I wouldn't mind having as much as possible data about individual users and papers out in the open.



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Paper->create();
			if($this->request->data['Paper']['APA'] === '' AND $this->request->data['Paper']['DOI'] === '') {
				$this->Session->setFlash(__('You did not provide any information. The paper could not be saved. Please, try again.'));
				$this->redirect(array('action' => 'add'));
			}
 			elseif ($this->request->data['Paper']['DOI'] === '') {
				$metadata = $this->Paper->fetchByFreeForm(urlencode($this->request->data['Paper']['APA']));
				$this->Session->setFlash(__('Metadata was automatically retrieved based on given reference and the DOI that resulted from the call.'));
			}
			else {
				$metadata = $this->Paper->fetchByDOI($this->request->data['Paper']['DOI']);
				$this->Session->setFlash(__('Metadata was automatically retrieved based on DOI.'));
			}
			$this->request->data['Paper']  = array_merge($this->request->data['Paper'], $metadata);
			
			if ($this->Paper->save($this->request->data)) {
				$this->Session->setFlash(__('The paper has been saved'));
				$this->redirect(array('action' => 'view', $this->Paper->getInsertID()));
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
