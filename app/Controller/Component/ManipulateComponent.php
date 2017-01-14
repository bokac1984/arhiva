<?php

App::uses('Component', 'Controller');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

/**
 * Description of ManipulateComponent
 *
 * @author bokac
 * 
 */
class ManipulateComponent extends Component {

    /**
     * Dozvoljene ekstenzije
     *
     * @var array 
     * 
     */
    private $allowedExtensions = array('pdf');
    
    private $folderLocation;
    
    private $tempFileLocation;
    
    public $name;
    public $date;
    public $price;
    public $fileLocation;
    
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
        $this->folderLocation = WWW_ROOT . 'uploads' . DS . 'javne_nabavke' . DS;
        $this->tempFileLocation = "D:\\ti-bih\\arhiva.ti-bih.org\\Javne nabavke\\DVD1" . DS;
    }
    public function changeNameOfFile($originalName = '') {
        $temporalName = '';
        if ($originalName !== '') {
            $temporalNameHashed = hash('sha512', $originalName);
            $temporalName = substr($temporalNameHashed, 0, 10);
        }
        
        return $temporalName;
    }    
    
    public function prepareFilename($filename = '') {
        $newName = str_replace(array(':', '\\', '/', ','), '', $filename);
        
        return $this->changeNameOfFile($newName);
    }    
        
    
    public function checkExtension($extension) {
        return in_array($extension, $this->allowedExtensions);
    }
    
    public function createDigitalName($filename = '') {
        $search = array('š','đ','ž','č','ć', ' ', ',', 'Š', 'Đ', 'Ž', 'Č', 'Ć');
        $replace = array('s','dj','z','c','c', '_', '', 's', 'dj', 'z', 'c', 'c');
        $newFilename = strtolower(rtrim($filename));
        return str_replace($search, $replace, $newFilename);
    }
    
    public function copyFile($folder = '', $path = '', $oldFileName = '') {
        $file = new File($this->tempFileLocation . $path);
        $fileName = $this->prepareFilename($oldFileName);
        
        if ($file->exists()) {
            $newFileName = $folder . DS . $fileName . '.pdf';
            if ($file->copy($newFileName)) {
                return $newFileName;
            }
        } 
        return '';
    }
    
    /**
     * oovdje bi trebalo da se kreira folder ako ne psotoji
     * ako postoji onda da se u taj folder kopira fajl sa imenom koje 
     * ce biti random po algiritmu odozgo kreiranom
     */
    public function processIt($path = '', $contractor = '', $contractName = '') {
        $digitalName = $this->createDigitalName($contractor);
        $folderName = $this->folderLocation . $digitalName;
        
        $digitalFolder = new Folder($folderName, true, 755);
        
        return $this->copyFile($digitalFolder->path, $path, $contractName);
    }

}
