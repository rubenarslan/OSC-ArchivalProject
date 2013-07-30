<?php
class Codedpaper extends AppModel {
	public $belongsTo = array('User','Paper');
	public $hasMany = array('Study' => array('dependent'=>TRUE));
	public $actsAs = array('Containable');
	public function createDummy ($paper_id = NULL, $user_id = NULL, $cascade = true) {
		$newcodedpaper['paper_id'] = $paper_id;
		$newcodedpaper['user_id'] = $user_id;
		$this->create(); # have to call this for save to work, but apparently it doesn't confound the find query.
		$this->Paper->id = $paper_id;
		
		$preexisting = $this->find('first',array('conditions' => $newcodedpaper));
		if( $preexisting ) { # use the user and paper id to see whether this has been coded by this user already, if so, send him there
			$message = __('You can\'t code the same paper twice. We thus took you to your first coding attempt.');
			$alert = 'alert-info';
			$cid = $preexisting['Codedpaper']['id'];
		}
		else if( $this->save($newcodedpaper) ) { # if not, create a new one, save it and send him there
			$message = __('A new paper can be coded now.');
			$alert = 'alert-success';
			$cid = $this->read(null);
			$cid = $cid['Codedpaper']['id'];
			if($cascade) {
				$this->Study->createDummy($cid);
			}
		} else {
			$message = __('The new coded paper could not be saved. Please, try again.');
			$alert = 'alert-error';
			$cid = null;
		}
		return array('cid' => $cid,'message' => $message,'alert'=>$alert);
	}
	public function findDeep($id) {
		return $this->find('first', # get this user's paper
			array(
				"recursive" => 3,
				"conditions" => array(
					'Codedpaper.id' => $id
					),
				'contain' => array(
					'Paper' => array(),
					'User' => array(),
					'Study' => array( 
						'order' => array('Study.name ASC','Study.id ASC'),
						'Test' => array(
							'order' => array('Test.name ASC','Test.id ASC'),
						),
					),
				) 
			));
	}
	public function compare ($id1 = NULL, $id2 = NULL) {
		$c1 = $this->findDeep($id1);
		$c2 = $this->findDeep($id2);
		unset($c1['Paper']);
		unset($c2['Paper']);
		unset($c1['Codedpaper']);
		unset($c2['Codedpaper']);
		
		function array_unshift_assoc(&$arr, $key, $val)
		{
		   $arr = array_reverse($arr, true); 
		   $arr[$key] = $val; 
		   $arr = array_reverse($arr, true); 
		   return $arr;
		}
		$c1 = array_unshift_assoc($c1,"Coder's Email", $c1['User']['email']);
		$c2 = array_unshift_assoc($c2,"Coder's Email", $c2['User']['email']);
		$c1 = array_unshift_assoc($c1,"Coder's Username", $c1['User']['username']);
		$c2 = array_unshift_assoc($c2,"Coder's Username", $c2['User']['username']);
		unset($c1['User']); 
		unset($c2['User']); 
		$c1 = Set::remove($c1,'Study.{n}.Codedpaper');
		$c1 = Set::remove($c1,'Study.{n}.created');
		$c1 = Set::remove($c1,'Study.{n}.modified');
		$c1 = Set::remove($c1,'Study.{n}.certainty_key_effect_tests');
		$c1 = Set::remove($c1,'Study.{n}.certainty_replication_status');

		$c2 = Set::remove($c2,'Study.{n}.Codedpaper');
		$c2 = Set::remove($c2,'Study.{n}.created');
		$c2 = Set::remove($c2,'Study.{n}.modified');
		$c2 = Set::remove($c2,'Study.{n}.certainty_key_effect_tests');
		$c2 = Set::remove($c2,'Study.{n}.certainty_replication_status');
		
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.Study');
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.created');
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.modified');
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.certainty_hypothesis');
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.certainty_meth_var');
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.certainty_statistics');
		$c1 = Set::remove($c1,'Study.{n}.Test.{n}.certainty_hypothesis_supported');
		
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.Study');
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.created');
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.modified');
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.certainty_hypothesis');
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.certainty_meth_var');
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.certainty_statistics');
		$c2 = Set::remove($c2,'Study.{n}.Test.{n}.certainty_hypothesis_supported');
#		debug($c1);
		$c1 = Set::flatten($c1); 
		$c2 = Set::flatten($c2);
#		return array( Set::diff($c1,$c2), Set::diff($c2,$c1));
		$keys = array_merge(array_keys($c1),array_keys($c2));
		return array( $c1, $c2, $keys);
	}
}

