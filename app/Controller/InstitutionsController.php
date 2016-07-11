<?php

App::uses('AppController', 'Controller');

/**
 * Institutions Controller
 *
 * @property Institution $Institution
 * @property PaginatorComponent $Paginator
 */
class InstitutionsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    
    public $helpers = array('Link', 'Text');    
    
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow(
                'index', 
                'getFolders', 
                'getContracts', 
                'overview',
                'getContractsForInstitution');
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Institution->recursive = 0;
        $this->set('institutions', $this->Paginator->paginate());
    }
    
    public function pregled() {
        $this->Institution->recursive = 0;
        $this->set('institutions', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Institution->exists($id)) {
            throw new NotFoundException(__('Invalid institution'));
        }
        $options = array(
            'conditions' => array(
                'Institution.' . $this->Institution->primaryKey => $id
            ),
            'contain' => array(
                'Contract'
            )
        );
        $this->set('institution', $this->Institution->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Institution->create();
            if ($this->Institution->save($this->request->data)) {
                $this->Flash->success(__('The institution has been saved.'));
                $id = $this->Institution->getLastInsertID();
                return $this->redirect(array('action' => 'contract', $id));
            } else {
                $this->Flash->error(__('The institution could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Institution->exists($id)) {
            throw new NotFoundException(__('Invalid institution'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Institution->save($this->request->data)) {
                $this->Flash->success(__('The institution has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The institution could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Institution.' . $this->Institution->primaryKey => $id));
            $this->request->data = $this->Institution->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Institution->id = $id;
        if (!$this->Institution->exists()) {
            throw new NotFoundException(__('Invalid institution'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Institution->delete($id, true)) {
            $this->Flash->success(__('The institution has been deleted.'));
        } else {
            $this->Flash->error(__('The institution could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function removeAll() {
        foreach ($this->request->data as $id ) {
            $this->Institution->delete($id, true);
        }
    }


    public function contract($id = null) {
        $this->Institution->id = $id;
        if (!$this->Institution->exists()) {
            throw new NotFoundException(__('Invalid institution'));
        }
        $this->Institution->recursive = -1;
        $institution = $this->Institution->find('first', array(
            'conditions' => array(
                'Institution.id' => $id
            )
        ));
        
        $this->set(compact('id', 'institution'));
    }
    public function contracts($id = null) {

    }    
    
    public function viewer() {
        $institutions = $this->Institution->find('list');
        
        $this->set(compact('institutions'));
    }
    
    public function getFolders() {
        $this->viewClass = 'Json';
        
        $institutions = $this->Institution->find('list');
        
        $this->set(compact('institutions'));
        
    }
    
    public function getContracts() {
        $this->viewClass = 'Json';
        
        $contracts = $this->Institution->Contract->find('all', array(
            'conditions' => array(
                'Contract.institution_id' => $this->request->query['parent']
            )
        ));
        
        $this->set(compact('contracts'));
        
    } 
    
    public function getContractsForInstitution() {
        $this->viewClass = 'Json';
        $this->Institution->id = $this->request->data['id'];
        if (!$this->Institution->exists()) {
            throw new NotFoundException(__('Ne postoji institucija!'));
        }        
        $contracts = $this->Institution->Contract->find('all', array(
            'conditions' => array(
                'Contract.institution_id' => $this->request->data['id']
            ),
            'order' => array(
                'Contract.datum' => 'ASC'
            ),
            'contain' => array(
                'Institution' => array(
                    'fields' => array(
                        'Institution.view_count',
                        'Institution.id'
                    )
                )
            )
        ));
        
        //update ViewCoutn here but only if hasn't read item
        if($this->Session->check('has_read_item.' . $this->request->data['id']) === false) {
            $this->Institution->updateInstitutionViews($contracts[0]['Institution']['view_count'], 
                    $contracts[0]['Institution']['id']);
            $this->Session->write('has_read_item.' . $this->request->data['id'], true);
        }
        
        $this->set(compact('contracts'));
        
    }    
    
    public function upload() {
        $this->autoRender = false;
        $fileData = pathinfo($this->request->params['form']['file']['name']);
        
        $data = $this->Institution->prepareData($fileData['filename']);
        
        
        $institutionData = array(
            'name' => $data['name'],
            'description' => 'Added automatically ' . $data['name']
        );

        $this->Institution->createInstitution($institutionData);
        
        $institution = $this->Institution->find('first', array(
            'conditions' => array(
                'Institution.name' => $data['name']
            ),
            'fields' => array(
                'Institution.disk_location',
                'Institution.id'
            )
        ));

        $filenameToSave = $this->Upload->uploadDigitalPDF(
                $this->request->params['form']['file'], 
                $data['author'], 
                $institution['Institution']['disk_location']);
        
        $dataContract = array(
            'Contract' => array(
                'file_location' => $this->Upload->fileLocation,
                'name' => str_replace(',', '', $data['author']),
                'datum' => date('Y-m-d', strtotime(str_replace('-', '/', $data['date']))),
                'price' => $data['price'],
                'institution_id' => $institution['Institution']['id'],
                'original_name' => $this->request->params['form']['file']['name'],
                'file_size' => $this->request->params['form']['file']['size'],
                'new_file_name' => $filenameToSave
            )
        );
        //debug($dataContract);exit();
        if ($this->Institution->Contract->save($dataContract)) {
            echo 'usphe';
        } else {
            echo 'ne mozee';
        }
    }   
    
    public function overview() {
        $institutions = $this->Institution->find('all', array(
            'fields' => array(
                'Institution.id',
                'Institution.name',
                'Institution.contract_count'               
            ),
            'contain' => array(
                'Contract' => array(
                    'fields' => array(
                        'Contract.name'
                    )
                )
            )
        ));
        
        $this->set(compact('institutions'));
    }

}
