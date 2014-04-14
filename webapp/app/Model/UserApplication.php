<?php
App::uses('AppModel', 'Model');
/**
 * UserApplication Model
 *
 */
class UserApplication extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_application';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public $belongsTo = 'Application';

}
