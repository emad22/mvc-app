<?php
namespace PHPMVC\LIB;

class Messenger {
    
//    const APP_MESSEGE_SUCCESS  = 1;
//    const APP_MESSEGE_ERROR    = 2;
//    const APP_MESSEGE_WARRING  = 3;
//    const APP_MESSEGE_INFO     = 4;
    
    const APP_MESSEGE_SUCCESS  = 'success';
    const APP_MESSEGE_ERROR    = 'danger';
    const APP_MESSEGE_WARRING  = 'warning';
    const APP_MESSEGE_INFO     = 'info';

    private static $_instance;
    private  $_session;
    private  $_messages = [];
    
    
    
    private function __construct($session) {
        $this->_session = $session;
    }
//    private function clone(){}
    public static function getinstance(MYSessionHandler $session) {
        if(self::$_instance  === null){
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }  
   
   
    
    public function add($message , $type = self::APP_MESSEGE_SUCCESS){
        
        if(!$this->messagesExists()){
            $this->_session->messages = [];
        }        
        $mess = $this->_session->messages;        
        $mess = [$message,$type];        
        $this->_session->messages =$mess;
       
        
    }
    
    private function messagesExists(){
        return isset($this->_session->messages);
    }
    
    public function getMessage(){
        
        
        if($this->messagesExists()){
            
            $this->_messages = $this->_session->messages;
             
            unset($this->_session->messages);
            
            return $this->_messages;
        }
        return [];
    }
}
