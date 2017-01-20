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
        $search = array('š', 'đ', 'ž', 'č', 'ć', ' ', ',', 'Š', 'Đ', 'Ž', 'Č', 'Ć');
        $replace = array('s', 'dj', 'z', 'c', 'c', '_', '', 's', 'dj', 'z', 'c', 'c');
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

    /**
     * Metoda kojom se nalazi fajl u bazi
     * Ove metode ce da koriste modeli
     * 
     * @param type $name
     * @return string
     */
    public function getFile($name = null) {
        $file = $this->find('first', array(
            'conditions' => array(
                "{$this->alias}.new_file_name" => $name
            ),
            'fields' => array(
                "{$this->alias}.file_location",
                "{$this->alias}.id",
                "{$this->alias}.downloaded"
            )
        ));

        if (!empty($file)) {
            $this->updateDownloaded($file[$this->alias]['id'], $file[$this->alias]['downloaded']);
            return $file[$this->alias]['file_location'];
        }
        return '';
    }

    /**
     * Povecaj broj downloada
     * 
     * @param type $id
     * @param type $downloaded
     */
    public function updateDownloaded($id = null, $downloaded = null) {
        $data = array(
            "{$this->alias}" => array(
                'id' => $id,
                'downloaded' => $downloaded + 1
            )
        );

        $this->save($data);
    }

    /**
     * 
     * Vrati sumu i broj ugovora za odredjeni tip kompanije
     * 
     * @param string $groupByColumn Moze biti: naruciclas | dobavljac
     * @param int $id
     * @return array
     */
    public function getSumAndCount($groupByColumn, $id) {
        $temp = array();
        $data =  $this->find('all', array(
            'conditions' => array(
                "{$this->alias}.$groupByColumn" => $id,
                "{$this->alias}.display" => 1
            ),
            'fields' => array(
                "SUM({$this->alias}.price) as Suma",
                'COUNT(*) as brojUgovora'
            ),
            'group' => "{$this->alias}.$groupByColumn"
        ));
            
       if (count($data) > 0) {
           foreach ($data['0'] as $v) {
               $temp = $v;
           }
       }
       
       return $temp;
    }

}
