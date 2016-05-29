<?php

App::uses('Component', 'Controller');

/**
 * Description of UploadComponent
 *
 * @author bokac
 * 
 */
class UploadComponent extends Component {

    /**
     * Dozvoljene ekstenzije
     *
     * @var array 
     * 
     */
    private $allowedExtensions = array('pdf');
    
    public $name;
    public $date;
    public $price;
    public $fileLocation;
    
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }

    /**
     * 
     * @param type $uploadedPdf
     * @param type $location
     * @return boolean|string
     */
    public function uploadFile($uploadedPdf, $location = '/uploads/') {
        $fileName = '';
        if (empty($uploadedPdf) && $uploadedPdf['size'] === 0) {
            return $fileName;
        }
        
        $fileData = pathinfo($uploadedPdf['name']);
        
        if (!$this->checkExtension($fileData['extension'])) {
            return $fileName;
        }
        
        $fileName = $this->createFileName($fileData['filename']) 
                . "_" . $this->changeNameOfFile($fileData['filename']);
        $uploadLocation = WWW_ROOT . 'uploads' . DS . $location . DS .  $fileName . ".pdf";
        $this->fileLocation = $uploadLocation;

        if (move_uploaded_file($uploadedPdf['tmp_name'], $uploadLocation )) {
            return $fileName;
        }

        return '';
    }
    
    public function changeNameOfFile($originalName = '') {
        $temporalName = '';
        if ($originalName !== '') {
            $temporalNameHashed = hash('sha512', $originalName);
            $temporalName = substr($temporalNameHashed, 0, 5);
        }
        
        return $temporalName;
    }    
    
    public function checkExtension($extension) {
        return in_array($extension, $this->allowedExtensions);
    }
    
    public function createFileName($filename = '') {
        $extractedData = array();
        $datum = '';
        $price = '';
        
        // nadji datum, ali pazi na sve kombinacije
        if(preg_match("/(\d{2}(\.)?\d{2}(\.)?\d{4}\.)/", $filename, $match))
        {
            $datum = $match[0];
            $extractedData['date'] = $datum;
            $replacment = '***';
            $filename = preg_replace("/$datum/", $replacment, $filename);
        }
        if(preg_match("/(\d+(?:[\.\,]\d{2})?[KM| KM])/", $filename, $match2))
        {
            $price = $match2[0];
            $extractedData['price'] = $price;
            $replacment = '***';
            $filename = preg_replace("/$price/", $replacment, $filename);    
        }
        
        if (preg_match("/(\d{2}\.|\d{3}\.)/i", $filename, $match3)) {
            $replacable = $match3[0];
            $filename = preg_replace("/$replacable/", '', $filename);  
        }

        $nameString = explode("***", $filename);
        $extractedData['name'] = trim($nameString[0]);
        
        $extractedData['name'] = str_replace(array(':', '\\', '/', ','), '', $extractedData['name']);
        
        $this->name = $extractedData['name'];
        $this->date = $this->prepareDate($datum);
        $this->price = $price;
        $search = array('š','đ','ž','č','ć', ' ');
        $replace = array('s','dj','z','c','c', '_');
        $nameForFile = str_replace($search, $replace, $extractedData['name']);
        
        return $nameForFile;
    }    
    
    public function prepareDate($datum = '') {
        $dateWitoutDots = str_replace(".", "", $datum);
        $dateArray = str_split($dateWitoutDots);
        $day = $dateArray[0].$dateArray[1];
        $month = $dateArray[2].$dateArray[3];
        $year = $dateArray[4].$dateArray[5].$dateArray[6].$dateArray[7];
        return date("d.m.Y", strtotime("$day.$month.$year"));
    }

}
