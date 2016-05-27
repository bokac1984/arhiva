<?php
App::uses('Contract', 'Model');

/**
 * Contract Test Case
 */
class ContractTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contract',
		'app.institution'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contract = ClassRegistry::init('Contract');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contract);

		parent::tearDown();
	}

}
