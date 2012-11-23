<?php
class CodedpapersController extends AppController {
	public function show () {
		$specificallyThisOne = $this->Codedpaper->find('threaded', array(
		       'conditions' => array('Codedpaper.id' => 1),
				'recursive' => -1,
		   ));
		$this->set('thiscodedpaper', $specificallyThisOne);
	}
	public function code ($id = NULL) {
		$this->Codedpaper->id = $id;
		if (!$this->Codedpaper->exists()) {
		    throw new NotFoundException('Invalid paper');
		}
		if (!$this->request->is('get')){ # if it was posted or ajaxed
			if($this->Codedpaper->saveAssociated($this->request->data, 
				array("deep" => TRUE)
				)) {
				$this->Session->setFlash('Study Saved!');
			}
			else {
				$this->Session->setFlash("Could not save.");
			}
		}
		else {
			$this->request->data = $this->Codedpaper->find('first',array("recursive" => 3));
		}
	}
	public function morestudies () {
	}
	public function moreeffects () {
	}
	public function moretests () {
	}
}
