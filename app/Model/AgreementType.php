<?php

App::uses('AppModel', 'Model');

/**
 * AgreementType Model
 *
 * @property Agreement $Agreement
 */
class AgreementType extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Agreement' => array(
            'className' => 'Agreement',
            'foreignKey' => 'agreement_type_id',
            'dependent' => false,
            'conditions' => array(
                'Agreement.display' => '1'
            ),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function checkAndSave($name = '') {
        $exist = $this->find('all', array(
            'conditions' => array(
                'OR' => array(
                    "UPPER({$this->alias}.name)" => mb_strtoupper($name, 'UTF-8'),
                    "{$this->alias}.name" => $name,
                    "LCASE({$this->alias}.name)" => mb_strtolower($name, 'UTF-8'),

                ),
            ),
            'fields' => array(
                "{$this->alias}.id"
            )
        ));

        if (count($exist) === 1) {
            return $exist[0][$this->alias]['id'];
        } else if (count($exist) > 1) {
            return 0;
        }

        $dataToSave = array(
            "{$this->alias}" => array(
                'name' => $name
            )
        );

        $this->create();
        
        if ($this->save($dataToSave)) {
            return $this->getLastInsertID();
        }

        return 0;
    }

}
