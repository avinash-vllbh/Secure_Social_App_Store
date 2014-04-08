<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	
	public $salt = "salt";

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'First name is required',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Last name is required',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'enter a valid email address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Email id is required',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'We already have that email - try resetting password'
			),
		),
		'password' =>array(
			'not empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter your password'),
			'match passwords' =>array(
				'rule' => 'matchPasswords',
				'message' => 'Your passwords do not match')
		),
		'password_confirmation' => array(
			'not empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please confirm your password')
		),
		'phone' => array(
			//'notEmpty' => array(
				//'rule' => array('notEmpty'),
				//'message' => 'Last name is required',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		'token' => array(
			'isUnique' => array(
				'rule' => array('isUnique')))
	);
//Relationships for users
var $hasMany = array(
	'Application' => array(
		'className' => 'Application',
		'foreignKey' => 'user_id',
		//'conditions' => array('approved' = 1)
		'order' => 'rating DESC'
		),
	'UserFriend' => array(
		'className' => 'UserFriend',
		'foreignKey' => 'user_id',
		'conditions' => array('status' => 'approved'),
		'order' => 'friend_user_id DESC'
		),
	'UserFollower' => array(
		'className' => 'UserFollower',
		'foreignKey' => 'user_id',
		'order' => 'follower_user_id DESC'
		),
	// 'Group' => array(
	// 	'className' => 'Group',
	// 	'order' => 'id DESC'
	// 	),
	'GroupsUser' => array(
		'className' => 'GroupsUser',
		'order' => 'id DESC'
		),
	);
public function matchPasswords($data) {
	if($data['password'] == $this->data['User']['password_confirmation']) {
		return true;
	}
	$this->invalidate('password_confirmation', 'Your passwords do not match');
	return false;
}

public function beforeSave($options = array()) {
	if(isset($this->data['User']['password'])&& !empty($this->data['User']['password'])) {
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	}else {
        unset($this->data['User']['password']);
    }
	return true;
}
}
