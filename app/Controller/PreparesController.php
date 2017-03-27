<?php
App::uses('AppController', 'Controller');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PreparesController extends AppController {
    
    public $uses = array('Company', 'Prepare');
    
    private $goLeftRightMoves = 10;
    
    public function index() {
        $this->autoRender = false;
        $names = ($this->Company->find('all', array(
            'fields' => array(
                'Company.name', 'Company.id'
            ),
            'order' => array(
                'Company.name' => 'ASC'
            )
        )));
        
        $this->Prepare->prepareCompanies($names);
    }

}