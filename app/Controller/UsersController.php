<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
	public $actsAs = array('Acl' => array('type' => 'controlled'));
	public function beforeFilter() {
	        parent::beforeFilter();
	   //     $this->Auth->allow('register', 'logout');
	}
	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login($this->request->data['User'])) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash(__('Invalid username or password, try again'));
	        }
	    }
	}
	public function logout() {
	    $this->redirect($this->Auth->logout());
	}
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
			$this->request->data['User']['group_id'] = 3; # set to user group
            if ($this->User->save($this->request->data)) {
			 	$id = $this->User->id;
			    $this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
			    $this->Auth->login($this->request->data['User']);
                $this->Session->setFlash(__('You have been registered and logged in.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Registration unsuccessful. Please, try again.'));
            }
        }
    }
	public function acoinit () {
		$this->Acl->Aco->create(array('parent_id' => null, 'alias' => 'controllers'));
		$group = $this->User->Group;
	   //Allow admins to everything
	   	$group->id = 1;
		$this->Acl->allow($group,'controllers');
		
		//allow managers to posts and widgets
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers','Papers');
	    $this->Acl->allow($group, 'controllers','Users/index');
	    $this->Acl->allow($group, 'controllers','Codedpapers');

	    //allow users to only add and edit on posts and widgets
	    $group->id = 3;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers','Codedpaper/code');
	    //we add an exit to avoid an ugly "missing views" error message
	    echo "all done";
	    exit;
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
