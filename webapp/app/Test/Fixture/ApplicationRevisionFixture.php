<?php
/**
 * ApplicationRevisionFixture
 *
 */
class ApplicationRevisionFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'application_revision';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'app_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'comment' => 'Application id related to the revision number'),
		'revision_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'comment' => 'revision number of app., eg: 2.3.0', 'charset' => 'latin1'),
		'path' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'latin1_swedish_ci', 'comment' => 'full path of application stored in file system', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'revision_number' => 'Lorem ipsum dolor ',
			'path' => 'Lorem ipsum dolor sit amet'
		),
	);

}
