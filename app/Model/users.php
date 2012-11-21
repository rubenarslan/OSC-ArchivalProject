<?php
App::uses('AuthComponent', 'Controller/Component');
class user extends AppModel {
	public $belongsTo = 'group'
	public $actsAs = array('Acl' => array('type' => 'requester'));
	public $hasMany = 'codedpaper';
	public $displayField = 'name';
	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'group' => array(
            'valid' => array(
                'rule' => array('inList', array('admin','archivalprojectadmin', 'archivalprojectcoder')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
	public function parentNode() {
	        if (!$this->id && empty($this->data)) {
	            return null;
	        }
	        if (isset($this->data['User']['group_id'])) {
	            $groupId = $this->data['User']['group_id'];
	        } else {
	            $groupId = $this->field('group_id');
	        }
	        if (!$groupId) {
	            return null;
	        } else {
	            return array('Group' => array('id' => $groupId));
	        }
	}
}

