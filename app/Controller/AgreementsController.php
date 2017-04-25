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
            'pregled',
            'sendFile',
            'pravilnici',
            'agreement',
            'kompanije'
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
    
    public function kompanije()
    {
        
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
        $options = array('conditions' => array('Agreement.' . $this->Agreement->primaryKey => $id));
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
                $this->Flash->success(__('The agreement has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The agreement could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Agreement.' . $this->Agreement->primaryKey => $id));
            $this->request->data = $this->Agreement->find('first', $options);
        }
        $agreementTypes = $this->Agreement->AgreementType->find('list');
        $this->set(compact('agreementTypes'));
    }
    
    public function agreement() {
        $this->viewClass = 'Json';
        $letter = $this->request->data['letter'];
        //debug($this->request);exit();
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
            $file,
            array('download' => true, 'name' => $filename)
        );

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }

    /**
     * Ucitavanje podataka u bazu iz XML fajlova
     */
    public function obradi() {
        $this->autoRender = false;
        // local file
        $path1 = WWW_ROOT . DS . 'DVD1' . DS . 'data1ispravljeno.xml';
        $path2 = WWW_ROOT . DS . 'DVD2' . DS . 'data2.xml';
        $localPath = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\data1ispravljeno.xml';
        
        $xml = Xml::build($path2);
        
        $data = Xml::toArray($xml);
        
        //debug($data);
        $this->Agreement->saveToDatabase($data['nabavke']['nabavka']);
        echo 'DONE!';
    }
    
    public function redoFiles() {
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.created_new_name' => null,
                'Agreement.id' => 907
            ),
            'limit' => '1',
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
            $fileLocation = $this->Manipulate->processIt($v['Agreement']['path'], 
                $v['Purchase']['name'],
                $v['Agreement']['name']);  
            
            if ($fileLocation === '' || empty($fileLocation)) {
                echo 'nema lokacije0';
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
            
            debug($toSave);
            
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
            $fileLocation = $this->Manipulate->processIt($v['Agreement']['path'], 
                $v['Purchase']['name'],
                $v['Agreement']['name']);  
            
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
    public function copybackup() {
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.file_location' => null,
                'Agreement.new_file_name' => null
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
        echo (count($data)) ."<br/>";
        
        if (count($data) === 0) {
            echo 'vracam se<br/>';
            return;
        }
        
        foreach ($data as $k => $v) {
            $fileLocation = $this->Manipulate->processIt(
                $v['Agreement']['path'], 
                $v['Purchase']['name'],
                $v['Agreement']['name']);  
            
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
        echo (count($data)) ."<br/>";
        
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
                    strpos($zadnjeCifre, ',') === 0
                    || 
                    strpos($zadnjeCifre, '.') === 0
                ) {
                echo strpos($zadnjeCifre, ',')."<br>";
                
                // ako zadnje 2 cifer budu 00
                // cemo da radimo drugacije
                if ($zadnjeCifre === ',00'
                        || $zadnjeCifre === '.00'
                        ) {
                    $cijeliDio = substr($v['Agreement']['original_price'], 0, -3);
                } else {
                    $cijeliDio = str_replace($zadnjeCifre, '', $v['Agreement']['original_price']);
                }
                
                
                $cijeliDioBezZnakova = str_replace(array(',','.', ' '), '', $cijeliDio);
                $zadnjeCifreBezZnakova = str_replace(array(',', '.', ' '), '', $zadnjeCifre);
                //debug($v);
//                echo $v['Agreement']['price'] ."=".
//                        $v['Agreement']['original_price'] 
//                        ." = $cijeliDio"
//                            . " = $cijeliDioBezZnakova"
//                                . " = $zadnjeCifreBezZnakova"
//                        . " ********** ";                
//                echo $zadnjeCifre."<br />";
                $i++;
                
                $krajnjiBroj = $cijeliDioBezZnakova . "." . $zadnjeCifreBezZnakova;
                
                
                $flotBroj = number_format($krajnjiBroj, 2, '.', '');
                //echo "*****$krajnjiBroj = $flotBroj****";
                
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
