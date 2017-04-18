<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 */
class ContactsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Recaptcha.Recaptcha');
    
    public $helpers = array('Link');
    
    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add');
    }
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Contact->recursive = 0;
        $this->set('contacts', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException(__('Invalid contact'));
        }
        $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
        $this->set('contact', $this->Contact->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            if (!$this->Recaptcha->verify()) {
                unset($this->request->data['g-recaptcha-response']);
                $this->request->data['Contact']['sent'] = '1';
                $this->request->data['Contact']['ip'] = $this->request->clientIp();
                $this->Contact->create();
                if ($this->Contact->save($this->request->data)) {
                    $this->Flash->success(__('Uspješno ste poslali vašu poruku'));
                    $Email = new CakeEmail();
                    $Email->from(array('contact@tibih-database.org' => 'My Site'));
                    $Email->to('bokac1984@gmail.com');
                    $Email->subject('About');
                    $Email->send('My message');
                    
                    /**
                     * isprazni niz ako posaljemo, da mozemo popuniti ponovo polja
                     */
                    $this->request->data = array();
                    //return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('Nije moguće snimiti poruku. Pokušajte ponovo.'));
                } 
            } else {
                // display the raw API error
                $this->Contact->validationErrors['recaptcha'] = $this->Recaptcha->error;
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
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException(__('Invalid contact'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Contact->save($this->request->data)) {
                $this->Flash->success(__('The contact has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
            $this->request->data = $this->Contact->find('first', $options);
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
        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException(__('Invalid contact'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Contact->delete()) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
