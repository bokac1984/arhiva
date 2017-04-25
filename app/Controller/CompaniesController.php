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

    public $uses = array('Company', 'Prepare');
    
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
        $this->Paginator->settings = array(
            'limit' => 25,
            'order' => array(
                'Company.name' => 'ASC'
            ),
            'conditions' => array(
                'Company.merged' => '0'
            )
        );        
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

        $company = $this->Company->companyAgreements($id);
        
        $purchasePrice = $this->Company->PurchaseAgreement->getSumAndCount('purchase_id', $id);
        
        $supplierPrice = $this->Company->SupplierAgreement->getSumAndCount('supplier_id', $id);

        $this->set(compact('company', 'purchasePrice', 'supplierPrice'));
    }
    
    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function overview($id = null) {
        if (!$this->Company->exists($id)) {
            throw new NotFoundException(__('Nepostojeći ID firme'));
        }

        $company = $this->Company->companyAgreements($id);
        
        $purchasePrice = $this->Company->PurchaseAgreement->getSumAndCount('purchase_id', $id);
        
        $supplierPrice = $this->Company->SupplierAgreement->getSumAndCount('supplier_id', $id);

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
    
    public function merge() {
        $this->autoRender = false;
        //$this->viewClass = 'Json';
//        debug($this->request->data['ids']);exit();
        $ids = isset($this->request->data['ids']) && !empty($this->request->data['ids'])
                ? $this->request->data['ids']
                : array();
//        $main = isset($this->request->data['main']) && !empty($this->request->data['main'])
//                ? $this->request->data['main']
//                : 0;
        
        $ids  = $this->Company->prepareIds($ids);
        //debug($ids);
        foreach ($ids as $kompanije) {
            $main = $kompanije[0];
            $idss = array();
            for ($j = 1; $j < count($kompanije); $j++) {
                $idss[] = $kompanije[$j];
            }

            $this->Company->mergeCompanies($main, $idss);
        }
    }
    
    public function merger() {        
        if ($this->request->is(array('post', 'put'))) {
            $percent = isset($this->request->data['Company']['percent']) && !empty($this->request->data['Company']['percent'])
                ? $this->request->data['Company']['percent']
                : 99;
            
                $this->Prepare->percent = $percent;
                $names = ($this->Company->find('all', array(
                    'fields' => array(
                        'Company.name', 'Company.id'
                    ),
                    'order' => array(
                        'Company.name' => 'ASC'
                    ),
                    'conditions' => array(
                        'Company.merged' => '0'
                    )
                ))); 
                
                $newNames = $this->Prepare->prepareCompanyNames($names);
                //debug($newNames);
                $this->Prepare->prepareCompanies($names);

                $toBeMerged = $this->Prepare->exportedData;
                //debug($this->Prepare->makeStringy);exit();

                //debug($toBeMerged);

                $newData = array();
                $i = 0;
                foreach ($toBeMerged as $k => $v) {
                    //debug($v);
                    foreach ($v as $kk => $vv) {
                        $newData[$i][$vv] = $newNames[$vv];
                    }
                    $i++;
                }
                //debug(count($newData));
                //debug($newData);

                $this->set(compact('newData'));
        } else {
            
        }

        
        
        

        
//        foreach ($newData as $kk => $company) {
//            //debug($company);
//            foreach ($company as $k => $v) {
//                $data = array(
//                  'Prepare' => array(
//                      'company' => $k,
//                      'name' => $v,
//                      'parent' => $kk
//                  )  
//                );
//                $this->Prepare->create($data);
//                $this->Prepare->save($data);               
//            }
//
//        }
        //exit();
//        foreach ($toBeMerged as $kompanije) {
//            $main = $kompanije[0];
//            $ids = array();
//            for ($j = 1; $j < count($kompanije); $j++) {
//                $ids[] = $kompanije[$j];
//            }
//            $this->Company->mergeCompanies($main, $ids);
//        }
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
