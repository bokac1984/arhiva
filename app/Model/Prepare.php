<?php

App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

/**
 * Prepare Model
 *
 */
class Prepare extends AppModel {
    
    private $goLeftRightMoves = 30;
    public $percent = 95;
    public $companies = array();
    public $sorted = array();
    
    public $highest = array();
    
    public $exportedData = array();
    
    public $makeStringy = array();
    
    public function prepareCompanies($names) {  
        //debug($names);
        foreach($names as $k => $v) {
            //debug($v);
            $prvaIter = str_replace(array(',', '.', '\n', '&', '-'), '', strtoupper($v['Company']['name']));
            $drugaIter = str_replace(array('doo'), ' doo ', $prvaIter);
            $trecaIter = str_replace(array('  '), ' ', $drugaIter);
            $cetvrtiIter = preg_replace('!\s+!', ' ', $trecaIter);
            
            $this->companies[$k][$v['Company']['id']] = trim($cetvrtiIter);
            
        }
        
        //debug(count_chars('15 APRIL AD VIŠEGRAD', 3));
        //$this->prepareWords();
        
        //debug($this->companies[0][key($this->companies[0])]);
        $this->compareSimilarity();
        $this->getHighestSimilarities();
        //debug(count($this->highest));
        //debug($this->highest);
        $this->displayData();
        //debug($this->exportedData);
    }
    
    public function displayData() {
        $i = 0;
        foreach ($this->highest as $k => $v) {
            $temp = $k;
            $this->exportedData[$i][] = $k; 
            //print("$k.");
            foreach ($v as $kk => $vv) {
                $this->exportedData[$i][] = $vv['id']; 
                $temp .= '.' . $vv['id'];
                //print("{$vv['id']}.");
            }
            $this->makeStringy[] = $temp;
            $temp = '';
            $i++;
            //print("<br>");
        }
    }
    
    private function prepareWords() {
        similar_text('AD NESTROPETROL BANJA LUKA', 'AD NESTRO PETROL BANJA LUKA', $percent);
        
        echo $percent;
    }  
    
    public function compareSimilarity() {
        $numCompanies = count($this->companies);
        foreach ($this->companies as $id => $name) {
            //debug($id);
            $kljuc = key($name);
            for ($i = 1; $i < $this->goLeftRightMoves; $i++) {
                $noviKljuc = $i + $id;
                
                if ($noviKljuc < $numCompanies) {
                    //debug($noviKljuc);
                    $kljucKompanije = key($this->companies[$noviKljuc]);
                    similar_text($name[$kljuc], $this->companies[$i+$id][$kljucKompanije], $percent);
                    $this->sorted[$kljuc][] = array(
                       'id' => $kljucKompanije,
                       'percent' => $percent
                    );
                }

            }
        }
    }
    
    public function getHighestSimilarities() {
        foreach ($this->sorted as $k => $v) {
            foreach ($v as $procenti) {
                if ($procenti['percent'] >= $this->percent) {
                    $this->highest[$k][] = array(
                        'id' => $procenti['id'],
                        'percent' => $procenti['percent']
                    );
                }
            }
        }
    }
    
    public function prepareCompanyNames($names) {
        foreach ($names as $k => $v) {
            $as[$v['Company']['id']] = $v['Company']['name'];
        }
        
        return $as;
    }
}