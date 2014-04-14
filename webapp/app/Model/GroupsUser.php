<?php
App::uses('AppModel', 'Model');
/**
 * GroupsUser Model
 *
 */
class GroupsUser extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'groups_user';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group'
			),
		'User' => array(
			'className' => 'User',
			'fields' => array('User.id', 'User.first_name', 'User.last_name', 'User.email', 'User.phone', 'User.role')
			));

	//public $belongsTo = 'User';
	// var $belongsTo = array(
	// 	'Group' => array(
	// 		'classname' => 'Group',
	// 		'foreignkey' => 'group_id' ),
	// 	);

}
