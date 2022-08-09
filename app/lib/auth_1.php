<?php
namespace PHPMVC\LIB;

class Auth {
    
    private static $_instance;
    private  $_session;
    private $_execludedRoutes = [
        '/index/default',
        '/auth/logout',
        '/users/profile',
        '/users/changepassword',
        '/users/settings',
        '/language/default',
        '/accessdenied/default',
        '/notfound/notfound',
        '/test/default',
        '/usersgroups'
    ];


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
    
    public function hasAccess($controller , $action){
        $url = strtolower('/' . $controller . '/' . $action);
//        var_dump(in_array($url, $this->_execludedRoutes));
//        var_dump(in_array($url, $this->_session->u->privileges));
        var_dump($url);
        echo '<pre>';
        var_dump( $this->_session->u->privileges);
        var_dump(in_array($url, $this->_session->u->privileges));
        var_dump(in_array($url, $this->_execludedRoutes));
        echo '</pre>';
        if(in_array($url, $this->_execludedRoutes) || in_array($url, $this->_session->u->privileges)){
            echo 'yaaaaaaaaaaaaaaaaaaaaaa';
            return true;
        }
    }
}
