<?php
App::uses('Component', 'Controller');

/**
 * Description of Locate Component
 *
 * @author bokac
 * 
 */
class LocateComponent extends Component {

    /**
     * Podesavanje komponente
     *
     * @var array 
     * 
     */
    public $config = array(
        'apiUrl' => 'http://ipinfo.io/'
    );
    
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }
    
    private function getInfo($ip) {        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->config['apiUrl'] . $ip);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;       
    }
    
    private function makeCurlRequest($address)
    {
        $url = $this->config['apiUrl'] . $address;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }    

    public function fetchIpInfo($ip) {
        return $this->makeCurlRequest($ip);
    }
}
