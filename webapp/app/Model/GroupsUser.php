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

	public $belongsTo = 'Group';

	// var $belongsTo = array(
	// 	'Group' => array(
	// 		'classname' => 'Group',
	// 		'foreignkey' => 'group_id' ),
	// 	);

}
