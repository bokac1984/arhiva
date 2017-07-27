<?php
App::uses('AppModel', 'Model');
/**
 * Setting Model
 *
 * @property SettingSection $SettingSection
 */
class Setting extends AppModel {
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'value' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SettingSection' => array(
			'className' => 'SettingSection',
			'foreignKey' => 'setting_section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
