<?php

App::uses('AppController', 'Controller');

/**
 * Contacts Controller
 *
 * @property PaginatorComponent $Paginator
 */
class ContractsController extends AppController {
    
    public function index() {
        $Email = new CakeEmail();
        $Email->from(array('contact@tibih-database.org' => 'Arhiva TIBIH'));
        $Email->to('bokac1984@gmail.com');
        $Email->subject('About');
        $Email->send('My message');
    }
}

