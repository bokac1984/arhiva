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
            ),
            'fields' => array(
                'PurchaseAgreement.id',
                'PurchaseAgreement.name',
                'PurchaseAgreement.price',
                'PurchaseAgreement.contract_date',
                'PurchaseAgreement.new_file_name',
                'PurchaseAgreement.agreement_type_id',
                'PurchaseAgreement.supplier_id'
            )
        ),
        'SupplierAgreement' => array(
            'className' => 'Agreement',
            'foreignKey' => 'supplier_id',
            'conditions' => array(
                'SupplierAgreement.display' => '1'
            ),
            'fields' => array(
                'SupplierAgreement.id',
                'SupplierAgreement.name',
                'SupplierAgreement.price',
                'SupplierAgreement.contract_date',
                'SupplierAgreement.new_file_name',
                'SupplierAgreement.agreement_type_id',
                'SupplierAgreement.purchase_id'
            )
        ),
    );    

}
