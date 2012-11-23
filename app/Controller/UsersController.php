<?php
class UsersController extends AppController {
	 var $name = 'Users'; 
	public function beforeFilter() {
	        parent::beforeFilter();
	        $this->Auth->allow('add', 'logout');
	}
	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash(__('Invalid username or password, try again'));
	        }
	    }
	}
	public function logout() {
	    $this->redirect($this->Auth->logout());
	}
	public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
	public function view($id = null) {
	        $this->User->id = $id;
	        if (!$this->User->exists()) {
	            throw new NotFoundException(__('Invalid user'));
	        }
	        $this->set('user', $this->User->read(null, $id));
	}
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
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
            unset($this->request->data['User']['password']);
        }
    }
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
	public function acoinit () {
		$this->Acl->Aco->create(array('parent_id' => null, 'alias' => 'controllers'));
		$this->Acl->Aco->save();
	}
}
