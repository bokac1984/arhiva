<?php

App::uses('Shell', 'Console');
App::uses('CakeEmail', 'Network/Email');

/**
 * Contact Shell
 *
 * @package       app.Console.Command
 */
class CronShell extends Shell {

    public $uses = array('Contact');

    public function main() {
        $emailData = $this->Contact->unsentEmails(1);
        $this->sendContactEmail($emailData);
    }
    
    public function sendContactEmail($data = array()) {
        $Email = new CakeEmail('default');
        $Email->viewVars($data);
        $Email->template('arhiva') 
            ->emailFormat('both') 
            ->to('bob@example.com') 
            ->from('app@domain.com') 
            ->send();
    }
}
