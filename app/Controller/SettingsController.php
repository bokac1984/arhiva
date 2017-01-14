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
            debug($this->request->data);
        }        
        $debugLevel = Configure::read('debug');
        $this->set(compact('debugLevel'));
    }
}
