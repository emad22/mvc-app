<?php
namespace PHPMVC\LIB;

class Auth {
    
    private static $_instance;
    private  $_session;
    
    private function __construct($session) {
        $this->_session  = $session;
    }
    
    public static function getInstance(MYSessionHandler $session) {
        if(self::$_instance == null){
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    public function isAuthorized() {
//        var_dump($this->_session);
        return isset($this->_session->u);
        
    }
}
