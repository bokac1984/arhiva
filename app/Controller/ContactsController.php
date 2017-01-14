<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Contacts Controller
 *
 * @property PaginatorComponent $Paginator
 */
class ContactsController extends AppController {
    
    public function index() {
        $Email = new CakeEmail();
        $Email->to('bokac1984@gmail.com');
        $Email->send('Poruka sa kojom pokusavamo');
    }
}

