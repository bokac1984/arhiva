<?php

App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

/**
 * Settings Controller
 *
 * @property PaginatorComponent $Paginator
 */
class SettingsController extends AppController {


    public function index() {
        if ($this->request->is('post')) {
            $level = $this->request->data;
            if (Configure::write('debug', $level)) {
                $this->Flash->success(__('Uspjeh.'));
            } else {
                $this->Flash->error(__('Pojavio se problem, ponovi!'));
            }            
            Configure::write('debug', $level);
        }        
        $debugLevel = Configure::read('debug');
        $this->set(compact('debugLevel'));
    }
}
