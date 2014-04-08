<?php
/**
 * CommentFixture
 *
 */
class CommentFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'comment';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'app_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'application on which comment is made'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'user who made the comment'),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 140, 'collate' => 'latin1_swedish_ci', 'comment' => 'comment content', 'charset' => 'latin1'),
		'posted_date' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'record date time'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'app_id' => array('column' => 'app_id', 'unique' => 0),
			'user_id' => array('column' => 'user_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'app_id' => 1,
			'user_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'posted_date' => 1394293402
		),
	);

}
