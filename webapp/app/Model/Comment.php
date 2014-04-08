<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 */
class Comment extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'comment';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

}
