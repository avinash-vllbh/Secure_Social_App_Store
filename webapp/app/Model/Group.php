<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 */
class Group extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'groups';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	var $hasMany = array(
	'GroupsUser' => array(
	 	'className' => 'GroupsUser',
		'foreignKey' => 'group_id',
		'order' => 'id DESC'
		),
	);

	public $hasOne = 'User';

	// var $hasAndBelongsToMany = array(
	// 'User' => array(
	// 	'className' => 'User',
	// 	//'foreignKey' => 'group_user_id',
	// 	//'order' => 'id DESC'
	// 	),
	// );

}
