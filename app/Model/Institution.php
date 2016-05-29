<?php

App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

/**
 * Institution Model
 *
 * @property Contract $Contract
 */
class Institution extends AppModel {
    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Contract' => array(
            'className' => 'Contract',
            'foreignKey' => 'institution_id',
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
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        
        $name = $this->changeSerbianLetters($this->data['Institution']['name']);
        $dir = new Folder(WWW_ROOT . '/uploads/' . $name, true, 0755);
        $this->data['Institution']['disk_location'] = $name;
    }

}
