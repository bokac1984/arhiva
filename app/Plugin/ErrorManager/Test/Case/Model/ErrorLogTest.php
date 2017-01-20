<?php
App::uses('ErrorLog', 'ErrorManager.Model');

/**
 * ErrorLog Test Case
 *
 */
class ErrorLogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.error_manager.error_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ErrorLog = ClassRegistry::init('ErrorManager.ErrorLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ErrorLog);

		parent::tearDown();
	}

}
