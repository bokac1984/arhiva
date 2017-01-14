<?php

App::uses('Component', 'Controller');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

/**
 * Description of RecaptchaComponent
 *
 * @author bokac
 * 
 */
class RecaptchaComponent extends Component {

    /**
     * Podesavanje komponente
     *
     * @var array 
     * 
     */
    public $config = array(
        'googleUrl' => 'https://www.google.com/recaptcha/api/siteverify',
        'secretKey' => '6LcR2hEUAAAAAGLbxJx0g5oHn31YaiTLJHnVIDi5'
    );
    
    private $checkUrl;
    
    private $ipAddress;
    
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
        $this->ipAddress = $this->controller->request->clientIp();
    }
    
    private function checkCaptcha() {        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->checkUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;       
    }

    public function validRecaptcha() {
        if (empty($this->controller->request->data['g-recaptcha-response'])) {
            return false;
        }
        
        $this->prepareUrl($this->controller->request->data['g-recaptcha-response']);
        $r = $this->checkCaptcha();
        $res = json_decode($r, true);

        return empty($res['success']);
    }
    
    public function prepareUrl($answer) {
        $this->checkUrl = $this->config['googleUrl'] 
                . "?secret=" . $this->config['secretKey']
                . "&response=" . $answer ."&remoteip=" . $this->ipAddress;
    }
}
