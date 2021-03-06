<?php

App::uses('AppModel', 'Model');
App::uses('File', 'Utility');

/**
 * Contract Model
 *
 * @property Institution $Institution
 */
class Contract extends AppModel {
    
    public $locationToDelete;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'institution_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Institution' => array(
            'className' => 'Institution',
            'foreignKey' => 'institution_id',
            'counterCache' => array(
                'contract_count',
                'active_contract_count' => array('Contract.display' => 1)
            )
        )
    );
    
    public function beforeDelete($cascade = true) {        
        $data = $this->find('first', array(
            'conditions' => array(
                'Contract.id' => $this->id
            ),
            'fields' => array(
                'Contract.file_location'
            )
        ));
        
        $this->locationToDelete = $data['Contract']['file_location'];
        parent::beforeDelete($cascade);
    }
    
    public function afterDelete($cascade = true) {
        parent::afterDelete($cascade);
        
        $file = new File($this->locationToDelete);
        if ($file->delete()) {
            $this->locationToDelete = '';
            return true;
        } else {
            return false;
        }
    }
}
