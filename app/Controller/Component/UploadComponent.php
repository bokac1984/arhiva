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
        $uploadLocation = WWW_ROOT . 'uploads' . $location . $fileName . ".pdf";
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
        if(preg_match("/\d{2}.\d{2}.\d{4}./", $filename, $match))
        {
            $datum = $match[0];
            $extractedData['date'] = $datum;
            $replacment = '***';
            $filename = preg_replace("/$datum/", $replacment, $filename);
        }
        if(preg_match("/\d*,\d{2}(KM| KM)/", $filename, $match2))
        {
            $price = $match2[0];
            $extractedData['price'] = $price;
            $replacment = '***';
            $filename = preg_replace("/$price/", $replacment, $filename);    
        }

        $nameString = explode("***", $filename);
        $extractedData['name'] = trim($nameString[0]);
        
        $extractedData['name'] = str_replace(array(':', '\\', '/', ','), '', $extractedData['name']);
        
        $this->name = $extractedData['name'];
        $this->date = $datum;
        $this->price = $price;
        $search = array('š','đ','ž','č','ć', ' ');
        $replace = array('s','dj','z','c','c', '_');
        $nameForFile = str_replace($search, $replace, $extractedData['name']);
        
        return $nameForFile;
    }    

}
