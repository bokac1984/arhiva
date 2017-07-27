<?php

App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');

/**
 * Agreements Controller
 *
 * @property Agreement $Agreement
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class AgreementsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session', 'Manipulate');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow(
                'pregled', 'sendFile', 'pravilnici', 'agreement', 'kompanije'
        );
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Agreement->recursive = 0;
        $this->set('agreements', $this->Paginator->paginate());
    }

    public function kompanije() {

        $agreements = $this->Agreement->vratiPodatkeZaPregled('A', 'supplier_id');

        $firstChar = $this->Agreement->allFirstLettersAndNumbers('supplier_id');
        unset($firstChar[0]);

        $this->set(compact('agreements', 'firstChar'));
    }

    public function overview() {
        $this->Agreement->recursive = 0;

        $containOptions = array(
            'AgreementType' => array(
                'fields' => array(
                    'id',
                    'name'
                )
            ),
            'Purchase' => array(
                'fields' => array(
                    'id', 'name'
                )
            ),
            'Supplier' => array(
                'fields' => array(
                    'id', 'name'
                )
            ),
        );

        $fields = array(
            'Agreement.id',
            'Agreement.name',
            'Agreement.price',
            'Agreement.contract_date',
            'Agreement.new_file_name',
        );

        $this->Paginator->settings = array(
            'limit' => 25,
            'contain' => $containOptions,
            'order' => array(
                'Agreement.contract_date' => 'DESC',
                'Purchase.name'
            ),
            'conditions' => array(
                'Agreement.display' => '1'
            ),
            'fields' => $fields
        );

        $this->set('agreements', $this->Paginator->paginate());
    }

    /**
     * ovo bi trebala biti metoda za javni pregled sumirano po naruciocima
     */
    public function pregled() {

        $agreements = $this->Agreement->vratiPodatkeZaPregled('A');

        $firstChar = $this->Agreement->allFirstLettersAndNumbers();
        unset($firstChar[0]);

        $this->set(compact('agreements', 'firstChar'));
    }

    public function pravilnici() {
        $this->Agreement->recursive = 0;

        $containOptions = array(
            'AgreementType' => array(
                'fields' => array(
                    'id',
                    'name'
                )
            ),
            'Purchase' => array(
                'fields' => array(
                    'id', 'name'
                )
            ),
            'Supplier' => array(
                'fields' => array(
                    'id', 'name'
                )
            ),
        );

        $fields = array(
            'Agreement.id',
            'Agreement.name',
            'Agreement.price',
            'Agreement.contract_date',
            'Agreement.new_file_name',
        );

        $this->Paginator->settings = array(
            'limit' => 25,
            'contain' => $containOptions,
            'order' => array(
                //'Agreement.contract_date' => 'DESC',
                'Purchase.name'
            ),
            'conditions' => array(
                'Agreement.display' => '0',
                'Agreement.name LIKE' => '%pravilnik%'
            ),
            'fields' => $fields
        );

        $this->set('agreements', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Agreement->exists($id)) {
            throw new NotFoundException(__('Invalid agreement'));
        }
        $options = array('conditions' => array('Agreement.' . $this->Agreement->primaryKey => $id),
            'contain' => array('Purchase', 'Supplier', 'AgreementType'));
        $this->set('agreement', $this->Agreement->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Agreement->create();
            if ($this->Agreement->save($this->request->data)) {
                $this->Flash->success(__('The agreement has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The agreement could not be saved. Please, try again.'));
            }
        }
        $agreementTypes = $this->Agreement->AgreementType->find('list');
        $this->set(compact('agreementTypes'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Agreement->exists($id)) {
            throw new NotFoundException(__('Invalid agreement'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Agreement->save($this->request->data)) {
                $this->Flash->success(__('Sacuvana promjena na ugovoru.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Promjena nije sacuvana, pokusajte opnovo.'));
            }
        } else {
            $options = array('conditions' => array('Agreement.' . $this->Agreement->primaryKey => $id));
            $this->request->data = $this->Agreement->find('first', $options);
        }
        $agreementTypes = $this->Agreement->AgreementType->find('list');
        $this->set(compact('agreementTypes'));
    }

    public function search() {
        if ($this->request->is('get')) {
            $keyword = $this->request->query['what'];


            $containOptions = array(
                'AgreementType' => array(
                    'fields' => array(
                        'id',
                        'name'
                    )
                ),
                'Purchase' => array(
                    'fields' => array(
                        'id', 'name'
                    )
                ),
                'Supplier' => array(
                    'fields' => array(
                        'id', 'name'
                    )
                ),
            );

            $fields = array(
                'Agreement.id',
                'Agreement.name',
                'Agreement.price',
                'Agreement.contract_date',
                'Agreement.new_file_name',
                'Agreement.path',
            );

            $this->Paginator->settings = array(
                'limit' => 25,
                'contain' => $containOptions,
                'order' => array(
                    //'Agreement.contract_date' => 'DESC',
                    'Purchase.name'
                ),
                'conditions' => array(
                    'Agreement.display' => '1',
                    'OR' => array(
                        'Agreement.name LIKE' => "%$keyword%",
                        'Purchase.name LIKE' => "%$keyword%",
                        'Supplier.name LIKE' => "%$keyword%",
                    )
                ),
                'fields' => $fields
            );
            $this->set('agreements', $this->Paginator->paginate());
        }

        $this->set('types', $this->Agreement->AgreementType->find('list', array(
                    'order' => 'AgreementType.name',
                    'conditions' => array('AgreementType.active' => 1)
        )));
    }

    public function agreement() {
        $this->viewClass = 'Json';
        $letter = $this->request->data['letter'];

        $supplier = isset($this->request->data['company']) ? 'supplier_id' : 'purchase_id';
        $agreements = $this->Agreement->vratiPodatkeZaPregled($letter, $supplier);
        $this->set(compact('agreements'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Agreement->id = $id;
        if (!$this->Agreement->exists()) {
            throw new NotFoundException(__('Invalid agreement'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Agreement->delete()) {
            $this->Flash->success(__('The agreement has been deleted.'));
        } else {
            $this->Flash->error(__('The agreement could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * Metoda za skidanje fajlova
     * 
     * @param type $filename
     * @return type
     * @throws NotFoundException
     */
    public function sendFile($filename = '') {
        $file = $this->Agreement->getFile($filename);

        if ($file === '') {
            throw new NotFoundException(__('Ne postoji fajl!'));
        }

        $this->response->type(array('pdf' => 'application/pdf'));
        $this->response->type('pdf');
        $this->response->file(
                $file, array('download' => true, 'name' => $filename)
        );

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }

    /**
     * Obavlja funkciju editable
     * 
     * @return void
     */
    public function editable() {
        $code = $this->Agreement->processEditable($this->request->data);

        $this->response->statusCode($code);

        return $this->response;
    }

    /**
     * Ucitavanje podataka u bazu iz XML fajlova
     */
    public function obradi($dvd = null) {
        $this->autoRender = false;

        if ($dvd == null || $dvd > 2 || $dvd < 1) {
            throw new NotFoundException(__('Ili 1 ili 2'));
        }

        // local file
        $path1 = WWW_ROOT . DS . 'DVD1' . DS . 'data1ispravljeno.xml';
        $path2 = WWW_ROOT . DS . 'DVD2' . DS . 'data2.xml';
        $localPath1 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\dvd1_ispravljeno.xml';
        $localPath2 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\dvd2_ispravljeno.xml';

        $xml = Xml::build(${'localPath' . $dvd});

        $data = Xml::toArray($xml);

        //debug($data);
        $this->Agreement->saveToDatabase($data['nabavke']['nabavka'], $dvd);
        echo 'DONE!';
    }

    /**
     * Ova metoda ce da pokusa da obradi dodatne
     * fajlove u kojima su podaci koji treba da se dopune
     * 
     * @param type $dvd
     * @throws NotFoundException
     */
    public function dopuni($dvd = null) {
        $this->autoRender = false;

        if ($dvd == null || $dvd > 2 || $dvd < 1) {
            throw new NotFoundException(__('Ili 1 ili 2'));
        }

        // local file
        $path1 = WWW_ROOT . DS . 'DVD1' . DS . 'data1ispravljeno.xml';
        $path2 = WWW_ROOT . DS . 'DVD2' . DS . 'data2.xml';
        $localPath1 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\dvd1_aca.xml';
        $localPath2 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\dvd2_aca.xml';

        $xml = Xml::build(${'localPath' . $dvd});

        $data = Xml::toArray($xml);

        $this->Agreement->findDifferences($data['nabavke']['nabavka'], $dvd);

        debug(count($this->Agreement->differences));

        if (!$this->Agreement->saveDifferences()) {
            echo 'NOT DONE!';
        }
        echo 'DONE!';
    }

    /**
     * lokalna metoda koja se koristi samo za poredjenje xmlova
     */
    public function compare() {
        $this->autoRender = false;
        $localPath1 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\dvd1_ispravljeno.xml';
        $localPath2 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\dvd1_pravilan.xml';

        $xml1 = Xml::build($localPath1);
        $xml2 = Xml::build($localPath2);

        $data1 = Xml::toArray($xml1);
        $data2 = Xml::toArray($xml2);

        $names = array(
            "narucilac", "dobavljac", "predmet", "price", "datum", "vrsta", "path"
        );
        $brojUkupan = count($data2['nabavke']['nabavka']);
        $brojPodredova = count($data1['nabavke']['nabavka'][0]);
        //debug($data1);
        for ($i = 0; $i < $brojUkupan; $i++) {
            for ($j = 0; $j < $brojPodredova; $j++) {
                if ($data1['nabavke']['nabavka'][$i][$names[$j]] !== $data2['nabavke']['nabavka'][$i][$names[$j]]) {
                    print "{$names[$j]} = {$data1['nabavke']['nabavka'][$i][$names[$j]]} !== {$data2['nabavke']['nabavka'][$i][$names[$j]]} => {$data1['nabavke']['nabavka'][$i]['path']}<br>";
                }
            }
        }
        echo 'DONE!';
    }

    public function missing() {
        $this->autoRender = false;
        $localPath1 = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\XML1906\\word.xml';

        $xml1 = Xml::build($localPath1);

        $data1 = Xml::toArray($xml1);

        $ugovori = $this->Agreement->find('all', array(
            'conditions' => array(
            //'Agreement.display' => 1
            ),
            'fields' => array(
                'name', 'id'
            )
        ));

        //debug($ugovori);
        $res = Hash::format($ugovori, array('{n}.Agreement.id', '{n}.Agreement.name'), '%1$s, %2$s');
        //$newArray = Hash::flatten($ugovori);
        //debug($res);
        //debug($this->strposa($ugovori, 'Ugovor o Izradi analize'));
//        debug(in_array('Ugovor o Izradi analize', $newArray));
        $flattened = Hash::flatten($data1['word']['text']);
        debug($flattened);
        $temp = array();
//        foreach ($flattened as $v) {
//            $ugovor = $this->strposa($res, $v);
//
//            if ($ugovor !== false) {
//                $temp[] = $ugovor;
//            }
//
//        }
        //debug($temp);
        echo 'DONE!';
    }

    private function strposa($haystack, $needle, $offset = 0) {
        if (empty($needle)) {
            return false;
        }
        foreach ($haystack as $v) {
            if (strpos($v, $needle) !== false) {
                return $v;
            }
        }
        return false;
    }

    public function testing() {
        $this->autoRender = false;
        echo $this->Manipulate->random_text();
    }

    public function redoFiles() {
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.created_new_name' => null
            ),
            'limit' => '1000',
            'fields' => array(
                'Agreement.id',
                'Agreement.path',
                'Agreement.name',
                'Agreement.file_location'
            ),
            'contain' => array(
                'Purchase' => array(
                    'fields' => array(
                        'Purchase.name'
                    )
                )
            )
        ));
        echo (count($data));

        if (count($data) === 0) {
            return;
        }

        foreach ($data as $k => $v) {
            $fileLocation = $this->Manipulate->processIt($v['Agreement']['path'], $v['Purchase']['name'], $v['Agreement']['name']);

            if ($fileLocation === '' || empty($fileLocation)) {
                break;
            }

            $toSave = array(
                'Agreement' => array(
                    'id' => $v['Agreement']['id'],
                    'new_file_name' => basename($fileLocation),
                    'file_location' => $fileLocation,
                    'old_file_location' => $v['Agreement']['file_location'],
                    'created_new_name' => '1'
                )
            );

            if (!$this->Agreement->save($toSave)) {
                echo "NOT SAVED";
            }
        }
        echo 'DONE!';
    }

    /**
     * Prvobitna metoda ya kopiranje fajlova
     * 
     * NE KORISTI SE VISE
     * 
     * @return type
     */
    public function kopiraj() {
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.file_location' => null
            ),
            'limit' => '1000',
            'contain' => array(
                'Purchase' => array(
                    'fields' => array(
                        'Purchase.name'
                    )
                )
            )
        ));
        echo (count($data));

        if (count($data) === 0) {
            return;
        }

        foreach ($data as $k => $v) {
            $fileLocation = $this->Manipulate->processIt($v['Agreement']['path'], $v['Purchase']['name'], $v['Agreement']['name']);

            if ($fileLocation === '' || empty($fileLocation)) {
                break;
            }

            $toSave = array(
                'Agreement' => array(
                    'id' => $v['Agreement']['id'],
                    'new_filename' => basename($fileLocation),
                    'disk_location' => $fileLocation,
                    'size' => filesize($fileLocation),
                    'display' => '1'
                )
            );

            if (!$this->Agreement->save($toSave)) {
                echo "NOT SAVED";
            }
        }
        echo 'DONE!';
    }

    /**
     * Kreiranje foldera i kopiranje fajlova iy pomocnih diskova (DVD1, DVD2)
     * 
     * @return type
     */
    public function create_files($dvd = '') {
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.file_location' => null,
                'Agreement.new_file_name' => null,
                'Agreement.dvd' => $dvd
            ),
            'limit' => '1000',
            'contain' => array(
                'Purchase' => array(
                    'fields' => array(
                        'Purchase.name'
                    )
                )
            )
        ));
        echo (count($data)) . "<br/>";

        if (count($data) === 0) {
            echo 'vracam se<br/>';
            return;
        }

        foreach ($data as $k => $v) {
            $fileLocation = $this->Manipulate->processIt(
                    $v['Agreement']['path'], $v['Purchase']['name'], $v['Agreement']['name'], $dvd);

            if ($fileLocation === '' || empty($fileLocation)) {
                break;
            }

            $toSave = array(
                'Agreement' => array(
                    'id' => $v['Agreement']['id'],
                    'new_file_name' => basename($fileLocation),
                    'file_location' => $fileLocation,
                    'size' => filesize($fileLocation),
                    'display' => '1'
                )
            );

            if (!$this->Agreement->save($toSave)) {
                echo "NOT SAVED";
            }
        }
        echo 'DONE!';
    }

    /**
     * Metoda koja se koristila da se cijena preuredi
     * 
     * I ovo se od danas ne koristi jer imam sve podatke spremne
     * 
     * @return type
     */
    public function cena() {
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.old_path' => null
            ),
            'limit' => '1000',
            'fields' => array(
                'Agreement.id',
                'Agreement.price',
                'Agreement.original_price'
            )
        ));
        echo (count($data)) . "<br/>";

        if (count($data) === 0) {
            echo 'vracam se<br/>';
            return;
        }
        $i = 0;
        foreach ($data as $k => $v) {

            echo $zadnjeCifre = substr($v['Agreement']['original_price'], -3);
            echo "<br/>";
            /**
             * ako ima ovo onda je sa zarezom iz preostalog dijela ukloni
             * sve zareze i tacke i onda formatiraj taj broj i zalijepi ovo ostalo
             * 
             */
            if (
                    strpos($zadnjeCifre, ',') === 0 ||
                    strpos($zadnjeCifre, '.') === 0
            ) {
                echo strpos($zadnjeCifre, ',') . "<br>";

                // ako zadnje 2 cifer budu 00
                // cemo da radimo drugacije
                if ($zadnjeCifre === ',00' || $zadnjeCifre === '.00'
                ) {
                    $cijeliDio = substr($v['Agreement']['original_price'], 0, -3);
                } else {
                    $cijeliDio = str_replace($zadnjeCifre, '', $v['Agreement']['original_price']);
                }


                $cijeliDioBezZnakova = str_replace(array(',', '.', ' '), '', $cijeliDio);
                $zadnjeCifreBezZnakova = str_replace(array(',', '.', ' '), '', $zadnjeCifre);
                //debug($v);
                $i++;

                $krajnjiBroj = $cijeliDioBezZnakova . "." . $zadnjeCifreBezZnakova;

                $flotBroj = number_format($krajnjiBroj, 2, '.', '');

                $dataToSave = array(
                    'Agreement' => array(
                        'id' => $v['Agreement']['id'],
                        'price' => $flotBroj,
                        'old_path' => $v['Agreement']['price']
                    )
                );

                if (!$this->Agreement->save($dataToSave)) {
                    echo "not saved {$v['id']}";
                }
                //
            } else {
                $dataToSave = array(
                    'Agreement' => array(
                        'id' => $v['Agreement']['id'],
                        'old_path' => $v['Agreement']['price']
                    )
                );

                if (!$this->Agreement->save($dataToSave)) {
                    echo "not saved {$v['id']}";
                }
            }
        }
        echo "Ukupno je bilo $i";
    }

}
