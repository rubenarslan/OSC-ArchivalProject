<?php
class CodedpapersController extends AppController {
	public $helpers = array("Html", "Form", "TwitterBootstrap.TwitterBootstrap", 'BootstrapCake.Bootstrap');
	public function show () {
		$specificallyThisOne = $this->Codedpaper->find('threaded', array(
		       'conditions' => array('Codedpaper.id' => 1)
		   ));
		$this->set('thiscodedpaper', $specificallyThisOne);
	}
}
