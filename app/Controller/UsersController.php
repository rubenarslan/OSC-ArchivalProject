<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		$req_action = $this->request->params['action'];
		
		if($req_action == 'edit' AND $user['Group']['name']==='admin') return true; # only admins can change groups
		elseif($req_action == 'edit') return false;
		
		if($admin) return true;
		
		if(in_array($req_action, array('index','leaderboard'))) return true; # viewing and adding is allowed to all users
	}
	public function leaderboard() {
		$this->set($this->User->getAchievement());
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
        $this->Session->setFlash(__('You have successfully logged out', 'alert-success'));
	    $this->redirect($this->Auth->logout());
	}
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
			$this->request->data['User']['group_id'] = 3; # set to user group
            if ($this->User->save($this->request->data)) {
			 	$id = $this->User->id;
			    $this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
			    $this->Auth->login();
                $this->Session->setFlash(__('You have been registered and logged in.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Registration unsuccessful. Please, try again.'));
            }
        }
    }
		public function forgotPassword() {
			if ($this->request->is('post')) {
			 	$user = $this->User->find('first', array(
					'fields' => array('email','id'),
					'conditions' => array('User.email' => $this->request->data['User']['email'] ),
					'limit' => 1,
				));
				$user = $user['User'];
		    	$reset_token = $this->User->generateResetToken($user['id']);
				$email = new CakeEmail('smtp');
				$email
				    ->to($user['email'])
				    ->subject(__('Reset password COS Archival Project'))
				    ->send(
"Dear user,

You asked us to send you a link to reset your 
password. If it wasn't you who requested the
link, please contact us by replying to this
email.

".Router::url( "/users/resetPassword/".$user['email']."/".$reset_token, true)
."

Best regards,

the COS Archival Project team");
				$this->Session->setFlash(__('The reset link was sent to your email address.'));
				$this->redirect("/");
			}
		}
		public function resetPassword($email = null,$reset_token = null) {
			if($reset_token == '' OR $reset_token == null OR $email == '' OR $email == null) throw new MethodNotAllowedException(__('Invalid reset token.'));
			if ($this->request->is('post')) {
			 	$user = $this->User->find('first', array(
						'fields' => array('id','hashed_reset_token'),
						'conditions' => array(
							'User.email' => $email,
							'User.reset_token_expiration >' => date('Y-m-d H:i:s') 
						)
				));
				$user_id = $user['User']['id'];
				$hashed_reset_token = $user['User']['hashed_reset_token'];
				$rehashed = AuthComponent::password($reset_token);
				if($user_id AND $hashed_reset_token === $rehashed) {
					$this->User->read(null,$user_id);
					$this->User->set(array(
						'hashed_reset_token' => null,
						'reset_token_expiration' => null,
						'password' => $this->request->data['User']['password'],
					));
					if($this->User->save()) {
						$this->Session->setFlash(__('Passwort successfully changed. Log in now.'),'alert-success');
						$this->redirect("/users/login");
					}
				} else {
					$this->Session->setFlash(__('Passwort reset token was invalid. Please follow the link in your email or copy it to the browser.'),'alert-error');
				}
			}
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
				$this->Session->setFlash(__('The user has been saved'),'alert-info');
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
