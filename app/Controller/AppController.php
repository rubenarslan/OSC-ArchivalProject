<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array("Html", "Form", "Js","TwitterBootstrap.TwitterBootstrap", 'BootstrapCake.Bootstrap');
	public $components = array(
			'Acl',
			'Session',
	        'Auth' => array(
		            'authorize' => array(
		                'Actions' => array('actionPath' => 'controllers/')
		            )
			),
			'RequestHandler'
			);
	function beforeFilter() {
	        $this->Auth->allow('index','view','login','logout','register','acoinit');
#		    $this->Auth->allow('*');
	        $this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login');
	        $this->Auth->logoutRedirect = array('controller' => 'Papers', 'action' => 'view');
	        $this->Auth->loginRedirect = array('controller' => 'Papers', 'action' => 'code');
	}
}
