<?php

App::uses('AppModel', 'Model');

/**
 * Company Model
 *
 */
class Company extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'Your custom message here',
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
    public $hasMany = array(
        'PurchaseAgreement' => array(
            'className' => 'Agreement',
            'foreignKey' => 'purchase_id',
            'conditions' => array(
                'PurchaseAgreement.display' => '1'
            )
        ),
        'SupplierAgreement' => array(
            'className' => 'Agreement',
            'foreignKey' => 'supplier_id',
            'conditions' => array(
                'SupplierAgreement.display' => '1'
            )            
        ),
    );    

}
