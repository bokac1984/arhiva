<?php

App::uses('AppModel', 'Model');

/**
 * Agreement Model
 *
 * @property AgreementType $AgreementType
 * @property Purchase $Purchase
 * @property Supplier $Supplier
 */
class Agreement extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'AgreementType' => array(
            'className' => 'AgreementType',
            'foreignKey' => 'agreement_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Purchase' => array(
            'className' => 'Company',
            'foreignKey' => 'purchase_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Supplier' => array(
            'className' => 'Company',
            'foreignKey' => 'supplier_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * Metoda kojom se snimaju podaci, ovo se koristi samo jednom.
     * @param type $data
     */
    public function saveToDatabase($data = array()) {
        foreach ($data as $k => $v) {
            $ugovor = array();
            //debug($v);exit();
            $purchase = $this->Purchase->checkAndSave($v['narucilac']);
            if ($purchase !== 0)
            {
                $ugovor['Agreement']['purchase_id'] = $purchase;
            } else {
                debug($v['path']);
                break;
            }
            
            $supplier = $this->Supplier->checkAndSave($v['dobavljac']);
            if ($supplier !== 0)
            {
                $ugovor['Agreement']['supplier_id'] = $supplier;
            } else {
                debug($v['path']);
                break;
            }
            
            $ugovor['Agreement']['name'] = isset($v['predmet']) ? $v['predmet'] : '';
            $ugovor['Agreement']['price'] = isset($v['price']) ? $v['price'] : '';
            $ugovor['Agreement']['contract_date'] = isset($v['datum']) ? $v['datum'] : '';
            $ugovor['Agreement']['path'] = $v['path'];
            
            $typeId = $this->AgreementType->checkAndSave($v['vrsta']);
            //debug($typeId);
            if ($typeId !== 0) {
                $ugovor['Agreement']['agreement_type_id'] = $typeId;
            } else {
                debug($v['path']);
                break;
            }
            $this->create();
            if (!$this->save($ugovor)) {
                debug($v['path']);
                break;
            }
        }
    }
    
    public function dajJedanUgovor($koji = array()) {
        $data = $this->find('first', array(
            'conditions' => array(
                'Agreement.name' => $koji['predmet'],
                'Agreement.path' => $koji['path']
            )
        ));
        debug($this->getLastQuery());
        if (count($data) > 0) {
            return $data;
        }
        
        return array();
    }
    
    public function fixMoneyProblem($data = array()) {
        $i = 0;
        foreach ($data as $k => $v) {
            $ugovor = $this->dajJedanUgovor($v);
            
            if (empty($ugovor)) {
                echo 'breakam ovo';
                break;
            }
            
            $cijena = $v['price'];
            if ($ugovor['Agreement']['price'] !== $cijena) {
                $i++;
            }
        }
        return $i;
    }
}
