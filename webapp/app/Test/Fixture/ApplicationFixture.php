<?php
/**
 * ApplicationFixture
 *
 */
class ApplicationFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'application';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary', 'comment' => 'application id'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'id of owner of application'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'application description', 'charset' => 'latin1'),
		'count_rating' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'comment' => 'no of users rated this application'),
		'rating' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1, 'comment' => 'application rating'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
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
			'user_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'count_rating' => 1,
			'rating' => 1
		),
	);

}
