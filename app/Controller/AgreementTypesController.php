<?php

App::uses('AppController', 'Controller');

/**
 * AgreementTypes Controller
 *
 * @property AgreementType $AgreementType
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class AgreementTypesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow(
            'view'
        );
    } 
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->AgreementType->recursive = 0;
        $this->set('agreementTypes', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->AgreementType->exists($id)) {
            throw new NotFoundException(__('Invalid agreement type'));
        }
        $options = array(
            'conditions' => array(
                'AgreementType.' . $this->AgreementType->primaryKey => $id
            ),
            'contain' => array(
                'Agreement' => array(
                    'Purchase',
                    'Supplier'
                )
            )
        );
        $this->set('agreementType', $this->AgreementType->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->AgreementType->create();
            if ($this->AgreementType->save($this->request->data)) {
                $this->Flash->success(__('The agreement type has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The agreement type could not be saved. Please, try again.'));
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
        if (!$this->AgreementType->exists($id)) {
            throw new NotFoundException(__('Invalid agreement type'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->AgreementType->save($this->request->data)) {
                $this->Flash->success(__('The agreement type has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The agreement type could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('AgreementType.' . $this->AgreementType->primaryKey => $id));
            $this->request->data = $this->AgreementType->find('first', $options);
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
        $this->AgreementType->id = $id;
        if (!$this->AgreementType->exists()) {
            throw new NotFoundException(__('Invalid agreement type'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->AgreementType->delete()) {
            $this->Flash->success(__('The agreement type has been deleted.'));
        } else {
            $this->Flash->error(__('The agreement type could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
