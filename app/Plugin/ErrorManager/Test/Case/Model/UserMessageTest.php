<?php
App::uses('UserMessage', 'ErrorManager.Model');

/**
 * UserMessage Test Case
 *
 */
class UserMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.error_manager.user_message'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserMessage = ClassRegistry::init('ErrorManager.UserMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserMessage);

		parent::tearDown();
	}

}
