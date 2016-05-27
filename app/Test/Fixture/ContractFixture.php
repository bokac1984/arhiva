<?php
/**
 * Contract Fixture
 */
class ContractFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'institution_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'date', 'null' => true, 'default' => null),
		'price' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'file_location' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'institution_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'date' => '2016-05-17',
			'price' => 1,
			'file_location' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-05-17 21:52:12',
			'modified' => '2016-05-17 21:52:12'
		),
	);

}
