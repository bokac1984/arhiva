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
            'overview',
            'sendFile'
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

    public function obradi() {
        return;
        $this->autoRender = false;
        // local file
        $path1 = WWW_ROOT . DS . 'DVD1' . DS . 'data1ispravljeno.xml';
        $path2 = WWW_ROOT . DS . 'DVD2' . DS . 'data2.xml';
        $localPath = 'D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\data1ispravljeno.xml';
        
        $xml = Xml::build($path1);
        
        $data = Xml::toArray($xml);
        
        //debug($data);
        $this->Agreement->saveToDatabase($data['nabavke']['nabavka']);
        echo 'DONE!';
    }
    
    public function kopiraj() {
        return;
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.disk_location' => null
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
    
    public function copybackup() {
        return;
        $this->autoRender = false;
        $data = $this->Agreement->find('all', array(
            'conditions' => array(
                'Agreement.disk_location' => '',
                'Agreement.new_filename' => ''
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
}
