<?php

App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

/**
 * Prepare Model
 *
 */
class Prepare extends AppModel {

    private $goLeftRightMoves = 50;
    public $percent = 95;
    public $companies = array();
    public $sorted = array();
    public $highest = array();
    public $exportedData = array();
    public $makeStringy = array();

    public function prepareCompanies($names) {
        //debug($names);exit();
        foreach ($names as $k => $v) {
//            $compName = $this->cleanName($v['Company']['name']);
//            $words = explode(' ', $compName);
            $this->companies[$k][$v['Company']['id']] = $this->cleanName($v['Company']['name']);//$words;
            //$this->companies[$v['Company']['id']] = $this->cleanName($v['Company']['name']);
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
            //sprint("$k.");
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
    
    public function compareEachWord($firstName, $secondName) {
        foreach($firstName as $word) {
            foreach ($secondName as $secondWord) {
                
            }
        }
    }

    public function compareSimilarity() {
        $inserted = array();
        $numCompanies = count($this->companies);
        
        $this->compareSimilar($this->companies);
        //debug($this->companies);exit();
//        foreach ($this->companies as $id => $name) {
//            //debug($id);
//            $kljuc = key($name);
//            for ($i = 1; $i < $this->goLeftRightMoves; $i++) {
//                $noviKljuc = $i + $id;
//                
//                if ($noviKljuc < $numCompanies) {
//                    //debug($noviKljuc);
//                    $kljucKompanije = key($this->companies[$noviKljuc]);
//                    // nadji slicnost tekstova i stavi u procenat
//                    similar_text($name[$kljuc], $this->companies[$i+$id][$kljucKompanije], $percent);
//                    /**
//                     * ako je procenat veci ili jednak
//                     * i ako vec nije insertovan ovaj kljuc negdje
//                     * tek onda ga dodaj u niz slicnih
//                     * 
//                     * Ovo je sve da bi se sprijecilo generisanje kraceg niza
//                     * sa svim podacim u duzem nizu
//                     */
//                    if ($percent >= $this->percent && !in_array($kljucKompanije, $inserted)) {
//                        $inserted[] = $kljucKompanije;
//                        $this->sorted[$kljuc][] = array(
//                           'id' => $kljucKompanije,
//                           'percent' => $percent
//                        );
//                    }
//                }
//
//            }
//        }
    }

    private function compareSimilar($data) {
        $length = count($data);
        //debug($data);
        $inserted = array();
        for ($i = 0; $i < $length; $i++) {
            if (!isset($data[$i])) {
                continue;
            }
            for ($j = $i + 1; $j < $length; $j++) {
                if (!isset($data[$j])) {
                    continue;
                }
                // nadji slicnost tekstova i stavi u procenat
                similar_text($data[$i][key($data[$i])], $data[$j][key($data[$j])], $percent);
                similar_text($data[$j][key($data[$j])], $data[$i][key($data[$i])], $percent2);
                /**
                 * ako je procenat veci ili jednak
                 * i ako vec nije insertovan ovaj kljuc negdje
                 * tek onda ga dodaj u niz slicnih
                 * 
                 * Ovo je sve da bi se sprijecilo generisanje kraceg niza
                 * sa svim podacim u duzem nizu
                 */
                
                //  debug ($percent . " = " . $percent2 ."; " .key($data[$i]) .": ". $data[$i][key($data[$i])] . " + ".key($data[$j]).": " .$data[$j][key($data[$j])]);
                if ($percent >= $this->percent && !in_array(key($data[$j]), $inserted)) {
                    //debug($inserted);
                    $inserted[] = key($data[$j]);
                    $this->sorted[key($data[$i])][] = array(
                        'id' => key($data[$j]),
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
