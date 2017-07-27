<?php

App::uses('AppController', 'Controller');

/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class SettingsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Setting->recursive = 0;
        $this->set('settings', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
        $this->set('setting', $this->Setting->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Setting->create();
            if ($this->Setting->save($this->request->data)) {
                $this->Flash->success(__('The setting has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        }
        $settingSections = $this->Setting->SettingSection->find('list');
        $this->set(compact('settingSections'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Setting->save($this->request->data)) {
                $this->Flash->success(__('The setting has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
        $settingSections = $this->Setting->SettingSection->find('list');
        $this->set(compact('settingSections'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Setting->id = $id;
        if (!$this->Setting->exists()) {
            throw new NotFoundException(__('Invalid setting'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Setting->delete()) {
            $this->Flash->success(__('The setting has been deleted.'));
        } else {
            $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function clear_cache() {
        
    }
    
    public function clear() {
        $code = Cache::clear() ? 200 : 404;
        
        $this->response->statusCode($code);
        
        return $this->response;
    }

}
