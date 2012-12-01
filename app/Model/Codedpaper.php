<?php
class Codedpaper extends AppModel {
	public $belongsTo = array('User','Paper');
	public $hasMany = array('Study' => array('dependent'=>TRUE));
	public function createDummy ($paper_id = NULL, $user_id = NULL, $cascade = true) {
		$newcodedpaper['paper_id'] = $paper_id;
		$newcodedpaper['user_id'] = $user_id;
		$this->create(); # have to call this for save to work, but apparently it doesn't confound the find query.
		$this->Paper->id = $paper_id;
		
		$preexisting = $this->find('first',array('conditions' => $newcodedpaper));
		if( $preexisting ) { # use the user and paper id to see whether this has been coded by this user already, if so, send him there
			$message = __('You can\'t code the same paper twice.');
			$cid = $preexisting['Codedpaper']['id'];
		}
		else if( $this->save($newcodedpaper) ) { # if not, create a new one, save it and send him there
			$message = __('A new paper can be coded now.');
			$cid = $this->read(null);
			$cid = $cid['Codedpaper']['id'];
		} else {
			$message = __('The new coded paper could not be saved. Please, try again.');
			$cid = null;
		}
		if($cascade) {
			$this->Study->createDummy($cid);
		}
		return array('cid' => $cid,'message' => $message);
	}
}

