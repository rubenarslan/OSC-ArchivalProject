<?php
class EffectsController extends AppController {
	function isAuthorized($user = null, $request = null) {	
		$admin = parent::isAuthorized($user); # allow admins to do anything
		if($admin) return true;

		$req_action = $this->request->params['action'];

		$effect_id = $this->request->params['pass'][0];
		$this->Effect->id = $effect_id;
		if (!$this->Effect->exists()) {
		    throw new NotFoundException('Invalid effect');
		}
		else {
			$allowed = $this->Effect->find('first',array(
				"recursive" => 2,
				"conditions" => array(
					'Effect.id' => $effect_id
					)
				));
			if( $allowed['Study']['Codedpaper']['user_id'] == $this->Auth->user('id')) { # is this the creator of the coded paper
				return true;
			}
		}
		return false;
	}
	public function delete($id = null) {
		$this->Effect->id = $id;
		if (!$this->request->is('ajax')) $ajax = TRUE; else $ajax = FALSE;
		if (!$this->Effect->exists()) {
			throw new NotFoundException(__('Invalid Effect'));
		}
		if ($this->Effect->delete()) {
			if($ajax) {
				$this->Session->setFlash(__('Effect deleted'));
				$this->redirect("/codedpapers/index_mine");
			} else {
				echo 'Test deleted';
				exit;
			}
		}
		$this->Session->setFlash(__('Effect was not deleted'));
		$this->redirect("/codedpapers/index_mine");
	}
}