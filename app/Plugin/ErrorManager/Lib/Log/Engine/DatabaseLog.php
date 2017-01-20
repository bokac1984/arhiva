<?php
App::uses('ClassRegistry', 'Utility');
App::uses('CakeLogInterface', 'Log');
App::uses('ErrorLog', 'ErrorManager.Model');

class DatabaseLog implements CakeLogInterface {

  public $Log = null;
  
  public $types = array('warning', 'error', 'critical', 'alert', 'emergency');
  
  public function __construct($options = array()) {
    $className = $options['model'];
    $this->Log = new $className();  
  }

  public function write($type, $message) {
    if (is_array($message)) {
      $message = print_r($message, true);
    }
    if (!in_array($type, $this->types)) {
      return false;
    }
    
    $this->Log->create();
    return $this->Log->save(array('error' => $message, 'type' => $type));
  }

}
