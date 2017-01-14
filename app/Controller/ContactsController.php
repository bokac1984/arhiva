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
        $Email->from(array('contact@tibih-database.org' => 'Arhiva TIBIH'));
        $Email->to('bokac1984@gmail.com');
        $Email->subject('Kontakt sa Arhive');
        $Email->replyTo('contact@tibih-database.org');
        $Email->send('Poruka sa kojom pokusavamo');
    }
}

