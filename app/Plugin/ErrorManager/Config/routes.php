<?php

Router::connect('/errormanager', 
        array(
            'plugin' => 'error_manager', 
            'controller' => 'error_logs', 
            'action' => 'index')   
        );

?>
