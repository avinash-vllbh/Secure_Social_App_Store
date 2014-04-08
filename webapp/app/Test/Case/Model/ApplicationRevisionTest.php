<?php
App::uses('ApplicationRevision', 'Model');

/**
 * ApplicationRevision Test Case
 *
 */
class ApplicationRevisionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.application_revision'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ApplicationRevision = ClassRegistry::init('ApplicationRevision');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ApplicationRevision);

		parent::tearDown();
	}

}
