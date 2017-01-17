<?php

App::uses('AppController', 'Controller');

/**
 * Companies Controller
 *
 * @property Company $Company
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CompaniesController extends AppController {

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
        $this->Company->recursive = 0;
        $this->set('companies', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Company->exists($id)) {
            throw new NotFoundException(__('Nepostojeći ID firme'));
        }
        
       // $this->Company->recursive = 2;
        $options = array('conditions' => 
            array(
                'Company.' . $this->Company->primaryKey => $id
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
                    )
                )
            )
        );
        $company = $this->Company->find('first', $options);
        
        $purchasePrice = $this->Company->PurchaseAgreement->find('all', array(
            'conditions' => array(
                'PurchaseAgreement.purchase_id' => $id,
                'PurchaseAgreement.display' => 1
            ),
            'fields' => array(
                'SUM(price) as Suma',
                'COUNT(*) as brojUgovora'
            ),
            'group' => 'PurchaseAgreement.purchase_id'
        ));
        
        $supplierPrice = $this->Company->SupplierAgreement->find('all', array(
            'conditions' => array(
                'SupplierAgreement.supplier_id' => $id,
                'SupplierAgreement.display' => 1
            ),
            'fields' => array(
                'SUM(price) as Suma',
                'COUNT(*) as brojUgovora'
            ),
            'group' => 'SupplierAgreement.supplier_id'
        ));
        
        $this->set(compact('company', 'purchasePrice', 'supplierPrice'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Company->create();
            if ($this->Company->save($this->request->data)) {
                $this->Flash->success(__('The company has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The company could not be saved. Please, try again.'));
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
        if (!$this->Company->exists($id)) {
            throw new NotFoundException(__('Invalid company'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Company->save($this->request->data)) {
                $this->Flash->success(__('The company has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The company could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Company.' . $this->Company->primaryKey => $id));
            $this->request->data = $this->Company->find('first', $options);
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
        $this->Company->id = $id;
        if (!$this->Company->exists()) {
            throw new NotFoundException(__('Invalid company'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Company->delete()) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
