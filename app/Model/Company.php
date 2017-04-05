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

    /**
     * Daj sve ugovore ove kompanije
     * 
     * @param type $id
     * @return type
     */
    public function companyAgreements($id) {
        $options = array('conditions' =>
            array(
                'Company.' . $this->primaryKey => $id
            ),
            'contain' => array(
                'PurchaseAgreement' => array(
                    'AgreementType' => array(
                        'fields' => array(
                            'id', 'name'
                        )
                    ),
                    'Supplier' => array(
                        'fields' => array(
                            'id', 'name'
                        )
                    ),
                    'order' => array(
                        'PurchaseAgreement.name' => 'asc'
                    )
                ),
                'SupplierAgreement' => array(
                    'AgreementType' => array(
                        'fields' => array(
                            'id', 'name'
                        )
                    ),
                    'Purchase' => array(
                        'fields' => array(
                            'id', 'name'
                        )
                    ),
                    'order' => array(
                        'SupplierAgreement.name' => 'asc'
                    )
                )
            )
        );

        $result = Cache::read('pregled_kompanije_' . $id, 'default');
        if (!$result) {
            Debugger::log('Nema kesirano ' . $id);
            $result = $this->find('first', $options);
            Cache::write('pregled_kompanije' . $id, $result, 'default');
        }
        return $result;
    }

    public function prepareIds($ids) {
        foreach ($ids as $v) {
            $temp[] = explode(',', $v);
        }
        
        return $temp;
    }
    
    public function mergeCompanies($main = 0, $toBeMerged = array()) {
        $newIds = array();
        /*
         * sklonimo onaj ID koji necemo da mijenjamo iz niza za mijenjanje
         */
        foreach ($toBeMerged as $id) {
            if ($id !== $main) {
                $newIds[] = $id;
            }
        }

        foreach ($newIds as $id) {
            $purchase = $this->PurchaseAgreement->updateAll(
                array(
                    'purchase_id' => $main,
                    'old_purchaser_id' => $id
                ), 
                array(
                        'PurchaseAgreement.purchase_id' => $id
                )
            );
            
            $supplier = $this->SupplierAgreement->updateAll(
                array(
                    'supplier_id' => $main,
                    'old_supplier_id' => $id
                ), 
                array(
                        'SupplierAgreement.supplier_id' => $id
                )
            );
            
            if ($purchase && $supplier) {
                $saved = $this->save(array(
                    'Company' => array(
                        'merged' => 1,
                        'id' => $id
                    )
                ));
                
                if (!$saved) {
                    echo 'nije sacuvao';
                }
            }
        }
    }

}
