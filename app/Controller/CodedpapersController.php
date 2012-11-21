<?php
class CodedpapersController extends AppController {
	public $helpers = array("Html", "Form", "TwitterBootstrap.TwitterBootstrap", 'BootstrapCake.Bootstrap');
	public function show () {
		$specificallyThisOne = $this->Codedpaper->find('threaded', array(
		       'conditions' => array('Codedpaper.id' => 1)
		   ));
		$this->set('thiscodedpaper', $specificallyThisOne);
	}
	public function code () {
		$specificallyThisOne = $this->Codedpaper->find('threaded', array(
		       'conditions' => array('Codedpaper.id' => 1)
		   ));
		$this->set('thiscodedpaper', $specificallyThisOne);
	}
	public function isAuthorized($user) {
	    // All registered users can code studies
	    if ($this->action === 'code') {
	        return true;
	    }

	    // The owner of a post can edit and delete it
	    if (in_array($this->action, array('edit'))) {
	        $postId = $this->request->params['pass'][0];
	        if ($this->Post->isOwnedBy($postId, $user['id'])) {
	            return true;
	        }
	    }

	    return parent::isAuthorized($user);
	}
}
