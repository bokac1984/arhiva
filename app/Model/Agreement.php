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

    /**
     *
     * @var array Razlika u nizovima podataka iz baze i onih iz ispravljenog Excela/XML 
     */
    public $differences = array();


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
            'conditions' => array(
                'AgreementType.active' => 1
            ),
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
     * Overridovana metoda iz AppModela da bi zadovoljia potrebe
     * ove klase za check and save
     * 
     * @param type $data
     * @return int
     */
    public function checkAndSaveAgrement($data = array()) {
        $result = $this->find('all', array(
            'conditions' => array(
                'Agreement.name' => $data['Agreement']['name'],
                'Agreement.price' => $data['Agreement']['price'],
                'Agreement.path' => $data['Agreement']['path'],
                'Agreement.original_price' => $data['Agreement']['original_price'],
                'Agreement.contract_date' => $data['Agreement']['contract_date'],
                'Agreement.agreement_type_id' => $data['Agreement']['agreement_type_id'],
                'Agreement.dvd' => $data['Agreement']['dvd'],
                'Agreement.purchase_id' => $data['Agreement']['purchase_id'],
                'Agreement.supplier_id' => $data['Agreement']['supplier_id'],
            ),
            'fields' => array(
                'Agreement.id'
            )
        ));


        if (count($result) > 0) {
            return 1;
        }

        return 0;
    }

    /**
     * nakon sto nadjemo razlike pokusaj da ih ispravish
     * 
     * @return boolean
     */
    public function saveDifferences() {
        if (empty($this->differences)) {
            return false;
        }
        foreach ($this->differences as $agreement_id => $type) {
            $typeId = $this->AgreementType->checkAndSave($type['agreement_type_id']['new']);
            $dataToSave = array(
                'id' => $agreement_id,
                'agreement_type_id' => $typeId
            );

            if (!$this->save($dataToSave)) {
                debug($dataToSave);
                return false;
            }
        }

        return true;
    }

    /**
     * Pogledaj da li ima razlike u podacima
     * izmedju podataka koji su TI ispravili i originala dostavljenih od Sectora
     * 
     * @param array $data
     */
    public function findDifferences($data = array(), $dvd = '') {
        foreach ($data as $ugovor) {
            $options = array(
                'conditions' => array(
                    'Agreement.name' => $ugovor['predmet'],
                    'Agreement.contract_date' => $ugovor['datum'],
                    'Agreement.path' => $ugovor['path'],
                    'Agreement.price' => $ugovor['price'],
                    'Agreement.dvd' => $dvd,
                    'Narucilac.cleaned_name' => $this->cleanName($ugovor['narucilac']),
                    'Dobavljac.cleaned_name' => $this->cleanName($ugovor['dobavljac']),
                ),
                'joins' => array(
                    array('alias' => 'VrstaPostupka',
                        'table' => 'agreement_types',
                        'type' => 'LEFT',
                        'conditions' => array(
                            '`VrstaPostupka`.`id` = `Agreement`.`agreement_type_id`'
                        )
                    ),
                    array('alias' => 'Narucilac',
                        'table' => 'companies',
                        'type' => 'LEFT',
                        'conditions' => array(
                            '`Narucilac`.`id` = `Agreement`.`purchase_id`'
                        )
                    ),
                    array('alias' => 'Dobavljac',
                        'table' => 'companies',
                        'type' => 'LEFT',
                        'conditions' => array(
                            '`Dobavljac`.`id` = `Agreement`.`supplier_id`'
                        )
                    ),
                ),
                'fields' => array(
                    'Agreement.id', 'Agreement.name', 'Agreement.contract_date', 'Agreement.price', 'Agreement.path',
                    'Narucilac.id', 'Narucilac.name',
                    'Dobavljac.id', 'Dobavljac.name',
                    'VrstaPostupka.id', 'VrstaPostupka.name'
                )
            );

            $dbUgovor = $this->find('first', $options);
            /**
             * Ako nije prazan onda pogledaj razlike u odnosu na XML podatke
             */
            if (!empty($dbUgovor)) {
                $this->checkDifference($dbUgovor, $ugovor);
            }
        }
    }

    /**
     * Metoda kojom se snimaju podaci, ovo se koristi samo jednom.
     * A sada moze i vise puta jer ne moze da snimi ako naidje na duplu akciju
     * @param type $data
     */
    public function saveToDatabase($data = array(), $dvd = 1) {
        foreach ($data as $k => $v) {
            $ugovor = array();
            //debug($v);exit();
            $purchase = $this->Purchase->checkAndSave(trim($v['narucilac']));
            if ($purchase !== 0) {
                $ugovor['Agreement']['purchase_id'] = $purchase;
            } else {
                debug($purchase);
                echo 'ne radi dobalvjac';
                debug($v['path']);
                break;
            }

            $supplier = $this->Supplier->checkAndSave(trim($v['dobavljac']));
            if ($supplier !== 0) {
                $ugovor['Agreement']['supplier_id'] = $supplier;
            } else {
                echo 'ne radi supplioer';
                debug($v['path']);
                break;
            }

            $ugovor['Agreement']['name'] = isset($v['predmet']) ? $v['predmet'] : '';
            $ugovor['Agreement']['price'] = isset($v['price']) ? $v['price'] : '';
            $ugovor['Agreement']['original_price'] = isset($v['price']) ? $v['price'] : '';
            $ugovor['Agreement']['contract_date'] = isset($v['datum']) ? $v['datum'] : '';
            $ugovor['Agreement']['path'] = $v['path'];
            $ugovor['Agreement']['dvd'] = $dvd;

            $typeId = $this->AgreementType->checkAndSave(trim($v['vrsta']));

            if ($typeId !== 0) {
                $ugovor['Agreement']['agreement_type_id'] = $typeId;
            } else {
                debug($v['path']);
                continue;
            }

            if ($this->checkAndSaveAgrement($ugovor) === 1) {
                echo "{$ugovor['Agreement']['path']} <br>";
                continue;
            }

            $this->create();
            if (!$this->save($ugovor)) {
                echo 'nije sacuvalo!';
                debug($v['path']);
                debug($this->validationErrors);
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

    /**
     * Pokusaj da se vrate podaci iz kesa za ovo da vidimo koliko ce brzo 
     * da ide
     * 
     * @return type
     */
    public function vratiPodatkeZaPregled($letter = '', $type = 'purchase_id') {
        $options['joins'] = array(
            array('table' => 'companies',
                'alias' => 'Company',
                'type' => 'INNER',
                'conditions' => array(
                    "Agreement.$type = Company.id",
                )
            )
        );
        $options['fields'] = array(
            'DISTINCT Company.id', 'Company.name'
        );
        $options['order'] = array(
            'Company.name' => 'ASC'
        );

        if ($letter !== '') {
            if ($letter === '#') {
                $options['conditions'] = array(
                    'AND' => array(
                        'Agreement.display' => '1',
                        'LEFT(Company.name, 1)' => array(
                            '1', '2', '3', '4', '5',
                            '6', '7', '8', '9', '0'
                        )
                    )
                );
            } else {
                $options['conditions'] = array(
                    'AND' => array(
                        'Agreement.display' => '1',
                        'LEFT(Company.name, 1)' => "$letter"
                    )
                );
            }
        } else {
            $options['conditions'] = array(
                'Agreement.display' => '1'
            );
        }

        $options['order'] = array(
            'Company.name'
        );

        $result = Cache::read('pregled_podaci_for_letter' . $letter, 'default');
        if ($result === false) {
            $this->log("Nema ga u kesu! -> $letter", 'debug');
            $result = $this->find('all', $options);
            Cache::write('pregled_podaci_for_letter' . $letter, $result, 'default');
        }
        return $result;
    }

    /**
     * 
     * @param string $type Tip ugovora, da li je supplier_id
     * ili purchase_id
     * @return type
     */
    public function allFirstLettersAndNumbers($type = 'purchase_id') {
        $options['joins'] = array(
            array('table' => 'companies',
                'alias' => 'Company',
                'type' => 'INNER',
                'conditions' => array(
                    "Agreement.$type = Company.id"
                )
            )
        );
        $options['fields'] = array(
            'DISTINCT LEFT(Company.name, 1) as firstLetter'
        );
        $options['order'] = array(
            'Company.name' => 'ASC'
        );
        $options['conditions'] = array(
            'Agreement.display' => '1',
            'NOT' => array(// There's your problem! :)
                'LEFT(Company.name, 1)' => array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0')
            )
        );

        return $this->find('all', $options);
    }

    /**
     * 
     * Pogledaj ima li razlike izmedju dve vriejdnosti
     * i ako ima postavi te razlike u privatni niz ove klase
     * 
     * NAPOMENA: Morao sam koristiti mb_strtoupper jer strtoupper nije
     * radio dobro iz razloga sto su stringovi bili razlicitih enkodinga
     * 
     * @param string $original
     * @param string $edited
     */
    private function checkDifference($original, $edited) {
        if (mb_strtoupper($original['VrstaPostupka']['name']) !== mb_strtoupper($edited['vrsta'])) {
            $this->differences[$original['Agreement']['id']]['agreement_type_id'] = array(
                'new' => $edited['vrsta'],
                'old' => array(
                    'id' => $original['VrstaPostupka']['id'],
                    'name' => $original['VrstaPostupka']['name']
                ),
                'path' => $edited['path']
            );
        }
    }

    /**
     * Get data agreements for company, with regards to supplier or purchaser
     * 
     * @param int $idCompany
     * @return array Containing results either from cache or from db
     */
    public function purchaseAgreements($idCompany) {
        $joinField = 'purchase_id';
        $searchField = 'supplier_id';
        /**
         * Ako je pretraga za supplier onda cemo da obrnemo ove parametre
         * i na taj nacin trazimo samo supplier firme
         */
        if ($this->alias == 'PurchaseAgreement') {
            $joinField = 'supplier_id';
            $searchField = 'purchase_id';
        }
        $options['joins'] = array(
            array('table' => 'companies',
                'alias' => 'Company',
                'type' => 'left',
                'conditions' => array(
                    "{$this->alias}.$joinField = Company.id"
                )
            ),
            array('table' => 'agreement_types',
                'alias' => 'AgreementType',
                'type' => 'left',
                'conditions' => array(
                    $this->alias . ".agreement_type_id = AgreementType.id"
                )
            )
        );
        $options['conditions'] = array(
            "{$this->alias}.purchase_id <> {$this->alias}.supplier_id",
            "{$this->alias}.$searchField" => $idCompany
        );
        $options['order'] = array(
            'Company.name' => 'ASC'
        );
        $options['fields'] = array(
            'Company.id', 'Company.name',
            $this->alias . '.id',
            $this->alias . '.name',
            $this->alias . '.price',
            $this->alias . '.contract_date',
            $this->alias . '.new_file_name',
            $this->alias . '.agreement_type_id',
            $this->alias . '.supplier_id',
            $this->alias . '.path',
            'AgreementType.id', 'AgreementType.name'
        );
        $result = Cache::read('pregled_kompanije_' . $idCompany . "_{$this->alias}", 'default');
        if ($result === false) {
            Debugger::log('Nema kesirano ' . $idCompany . "_{$this->alias}");
            $result = $this->find('all', $options);
            Cache::write('pregled_kompanije_' . $idCompany . "_{$this->alias}", $result, 'default');
        }
        return $result;
    }

    public function processEditable($data) {
        $type = isset($data['name']) ? $data['name'] : '';
        $newValue = isset($data['value']) ? $data['value'] : '';
        $id = isset($data['pk']) ? $data['pk'] : '';

        $this->id = $id;
        if (!$this->exists()) {
            return 400;
        }

        if ($type === '' || $newValue === '' || $id === '') {
            return 400;
        }

        $dataToSave = array(
            'Agreement' => array(
                'id' => $id,
                $type => $newValue
            )
        );

        if (!$this->save($dataToSave)) {
            return 400;
        }

        return 200;
    }

}
