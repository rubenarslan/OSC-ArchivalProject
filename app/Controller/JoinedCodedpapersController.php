<?php
App::uses('AppController', 'Controller');
/**
 * JoinedCodedpapers Controller
 *
 */
class JoinedCodedpapersController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
	function isAuthorized($user = null, $request = null) {	
			$admin = parent::isAuthorized($user); # allow admins to do anything
			if($admin) return true;

			$req_action = $this->request->params['action'];
			if(in_array($req_action, array())) return true; # viewing and indexing is allowed to all users
	}

}
