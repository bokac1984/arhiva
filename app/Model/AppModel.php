<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    public $recursive = -1;
    public $actsAs = array('Containable'); 
    
    public function changeSerbianLetters($location = '') {
        $search = array('š','đ','ž','č','ć', ' ', ',', 'Š', 'Đ', 'Ž', 'Č', 'Ć');
        $replace = array('s','dj','z','c','c', '_', '', 's', 'dj', 'z', 'c', 'c');
        $locationLower = strtolower(rtrim($location));
        return str_replace($search, $replace, $locationLower);
    }
    
    /**
     * Vraća zadnji kveri na bazu
     * 
     * @return string Kveri koji je zadnji iniciran
     */
    public function getLastQuery() {
        $dbo = $this->getDatasource();
        $logs = $dbo->getLog();
        $lastLog = end($logs['log']);
        return $lastLog['query'];
    }    
    
    public function checkAndSave($name = '') {
        $exist = $this->find('first', array(
            'conditions' => array(
                "{$this->alias}.name" => $name
            ),
            'fields' => array(
                "{$this->alias}.id"
            )
        ));

        if (count($exist) > 0) {
            return $exist[$this->alias]['id'];
        } 
        
        $dataToSave = array(
            "{$this->alias}" => array(
                'name' => $name
            )
        ); 
            
        $this->create();
        if ($this->save($dataToSave)) {
            return $this->getLastInsertID();
        }

        return 0;
    }
}
