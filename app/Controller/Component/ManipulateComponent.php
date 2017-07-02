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
    }

    public function startup(\Controller $controller) {
        $this->folderLocation = APP . 'uploaded_files' . DS . 'jn_data' . DS;
        $path1 = APP . 'uploaded_files' . DS . 'DVD1' . DS;
        $path2 = APP . 'uploaded_files' . DS . 'DVD2' . DS;

        $this->tempFileLocation = $path1;
        parent::startup($controller);
    }

    /**
     * Ova metoda ne valja, treba dodati da ne gleda samo ime
     * jer onda pravi dva ista hasha, moram ubaciti i vrijeme i jos neki random string
     * 
     * @param type $originalName
     * @return type
     */
    public function changeNameOfFile($originalName = '') {
        $temporalName = '';
        if ($originalName !== '') {
            /**
             * ubaci neki radnom na osnovu vremena
             */
            $now = $this->random_text();
            $temporalNameHashed = hash('sha512', $originalName . $now);
            $temporalName = substr($temporalNameHashed, 0, 15);
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
        $search = array('š', 'đ', 'ž', 'č', 'ć', ' ', ',', 'Š', 'Đ', 'Ž', 'Č', 'Ć');
        $replace = array('s', 'dj', 'z', 'c', 'c', '_', '', 's', 'dj', 'z', 'c', 'c');
        $newFilename = strtolower(rtrim($filename));
        return str_replace($search, $replace, $newFilename);
    }

    public function copyFile($folder = '', $path = '', $oldFileName = '') {
        $file = new File($this->tempFileLocation . $path);
        $fileName = $this->prepareFilename($oldFileName);
        // Executing this inside a CakePHP class:
        $this->log("Naziv fajla = $path -> $fileName", 'debug');

        if ($file->exists()) {
            $newFileName = $folder . DS . $fileName . '.pdf';
            $this->log("Naziv citave puitanje fajla = $newFileName", 'debug');
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

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * 
     * function from this link: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
     * 
     * @param type $type
     * @param type $length
     * @return type
     */
    public function random_text($type = 'alnum', $length = 15) {
        switch ($type) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }


        $crypto_rand_secure = function ( $min, $max ) {
            $range = $max - $min;
            if ($range < 0)
                return $min; // not so random...
            $log = log($range, 2);
            $bytes = (int) ( $log / 8 ) + 1; // length in bytes
            $bits = (int) $log + 1; // length in bits
            $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd >= $range);
            return $min + $rnd;
        };

        $token = "";
        $max = strlen($pool);
        for ($i = 0; $i < $length; $i++) {
            $token .= $pool[$crypto_rand_secure(0, $max)];
        }
        return $token;
    }

}
