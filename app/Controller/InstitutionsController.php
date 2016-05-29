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
    
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('index', 'getFolders', 'getContracts');
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
        if ($this->Institution->delete()) {
            $this->Flash->success(__('The institution has been deleted.'));
        } else {
            $this->Flash->error(__('The institution could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
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

}
