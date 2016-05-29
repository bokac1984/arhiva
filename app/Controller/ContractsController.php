<?php

App::uses('AppController', 'Controller');

/**
 * Contracts Controller
 *
 * @property Contract $Contract
 * @property PaginatorComponent $Paginator
 */
class ContractsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('sendFile');
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Contract->recursive = 0;
        $this->set('contracts', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Contract->exists($id)) {
            throw new NotFoundException(__('Invalid contract'));
        }
        $options = array('conditions' => array('Contract.' . $this->Contract->primaryKey => $id),
            'contain' => array(
                'Institution' => array(
                    'fields' => array(
                        'Institution.name', 'Institution.id'
                    )
                )
            ));
        $this->set('contract', $this->Contract->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Contract->create();
            if ($this->Contract->save($this->request->data)) {
                $this->Flash->success(__('The contract has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The contract could not be saved. Please, try again.'));
            }
        }
        $institutions = $this->Contract->Institution->find('list');
        $this->set(compact('institutions'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Contract->exists($id)) {
            throw new NotFoundException(__('Invalid contract'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Contract->save($this->request->data)) {
                $this->Flash->success(__('The contract has been saved.'));
                return $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Flash->error(__('The contract could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Contract.' . $this->Contract->primaryKey => $id));
            $this->request->data = $this->Contract->find('first', $options);
        }
        $institutions = $this->Contract->Institution->find('list');
        $this->set(compact('institutions'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Contract->id = $id;
        if (!$this->Contract->exists()) {
            throw new NotFoundException(__('Invalid contract'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Contract->delete()) {
            $this->Flash->success(__('The contract has been deleted.'));
        } else {
            $this->Flash->error(__('The contract could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function upload() {
        $this->autoRender = false;
        
        $disk_location = $this->request->data['location'];
        
        $filenameToSave = $this->Upload->uploadFile($this->request->params['form']['file'], $disk_location);
        
        $data = array(
            'Contract' => array(
                'file_location' => $this->Upload->fileLocation,
                'name' => $this->Upload->name,
                'datum' => $this->Upload->date,
                'price' => $this->Upload->price,
                'institution_id' => $this->request->data['institution_id'],
                'original_name' => $this->request->params['form']['file']['name'],
                'file_size' => $this->request->params['form']['file']['size'],
                'new_file_name' => $filenameToSave
            )
        );
        
        if ($this->Contract->save($data)) {
            echo 'usphe';
        } else {
            echo 'ne mozee';
        }
    }
    
    public function sendFile($filename = '') {
        $file = $this->Contract->getFile($filename);
        $this->response->type(array('pdf' => 'application/pdf'));
        $this->response->type('pdf');
        $this->response->file(
            $file,
            array('download' => true, 'name' => $filename.'.pdf')
        );

        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }

}
