<?php
App::uses('AppModel', 'Model');
/**
 * SettingSection Model
 *
 * @property Setting $Setting
 */
class SettingSection extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Setting' => array(
			'className' => 'Setting',
			'foreignKey' => 'setting_section_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
