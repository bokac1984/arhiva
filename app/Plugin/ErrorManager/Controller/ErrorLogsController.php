<?php

App::uses('ErrorManagerAppController', 'ErrorManager.Controller');

/**
 * ErrorLogs Controller
 *
 * @property ErrorLog $ErrorLog
 */
class ErrorLogsController extends ErrorManagerAppController {

    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'ErrorLog.created' => 'desc'
        )
    );
    public $components = array('ErrorManager.Locate');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->set('title_for_layout', Configure::read('Website.title') . ' - Error Manager');
        $this->ErrorLog->recursive = 2;
        $this->Paginator->settings = array(
            'order' => array(
                'ErrorLog.created' => 'DESC'
            )
        );
        // try paginate
        try {
            $logs = $this->paginate('ErrorLog');
            $this->set('errorLogs', $logs);
            $this->ErrorLog->markAsRead();
        } catch (NotFoundException $e) { // given page does not exist, someone is trying paging overflow
            $this->Session->setFlash(__('Don\'t do that, ok?'), 'flashError');
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->ErrorLog->exists($id)) {
            throw new NotFoundException(__('Invalid error log'));
        }
        $options = array('conditions' => array('ErrorLog.' . $this->ErrorLog->primaryKey => $id));
        $this->set('errorLog', $this->ErrorLog->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->ErrorLog->create();
            if ($this->ErrorLog->save($this->request->data)) {
                $this->Session->setFlash(__('The error log has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The error log could not be saved. Please, try again.'));
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
        if (!$this->ErrorLog->exists($id)) {
            throw new NotFoundException(__('Invalid error log'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ErrorLog->save($this->request->data)) {
                $this->Session->setFlash(__('The error log has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The error log could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('ErrorLog.' . $this->ErrorLog->primaryKey => $id));
            $this->request->data = $this->ErrorLog->find('first', $options);
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
        $this->ErrorLog->id = $id;
        if (!$this->ErrorLog->exists()) {
            throw new NotFoundException(__('Invalid error log'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ErrorLog->delete()) {
            $this->Session->setFlash(__('Error log deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Error log was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function getIpData() {
         $this->viewClass = 'Json';
         
         if (!$this->request->is('ajax')) {
             throw new MethodNotAllowedException(__('Nije dozvoljen ovaj način!'));
         }
         
         if (!isset($this->request->data['ip']) || empty($this->request->data['ip'])) {
             throw new BadRequestException('Ne smije biti prazno');
         }
         
         $ip = $this->request->data['ip'];
         
         $data = $this->Locate->fetchIpInfo($ip);
         
         $this->set(compact('data'));
    }

}
