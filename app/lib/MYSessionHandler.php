<?php
namespace PHPMVC\LIB;

//define('SESSION_SAVE_PATH', dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'sessions' );
//var_dump(SESSION_SAVE_PATH);

class MYSessionHandler extends \SessionHandler {
    
//    private $fich;
    
    private $SName = SESSION_NAME;
    private $SLIFETIME = SESSION_LIFE_TIME;
    private $TTL =1; //time to delete session
    private $SSecure = false;
    private $httponly = true;
    private $path = "/";
    private $domain = ".mvc-app.net";
    
    private $SPATH = SESSION_SAVE_PATH;
    private $key = 'secret_string';
//    private $sessionCipherAlgo     = 'aes-256-gcm';
//    private $sessionCipherKey     = 'mygsacdsad2016';
//    private $sessionCipherMode  = 'aes-256-gcm';
//    private $sessionCipherKey   = 'WYCRYPT0K3Y@20-20';




    public function __construct() {
//        $this->fich = $fich;
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_trans_sid', 0);
        ini_set('session.save_handler', 'files');
        
        session_name($this->SName);
        session_save_path($this->SPATH);
        session_set_cookie_params(
                $this->SLIFETIME, 
                $this->path, 
                $this->domain, 
                $this->SSecure, 
                $this->httponly
                );
//        session_set_save_handler($this, true);
    }
    public function __set($name, $value) {
        $_SESSION[$name]  = $value;
    }
    public function __get($name) {
        
        if($_SESSION[$name] !== false){
            return $_SESSION[$name];
        }else{
            return false;
        }
//        return false !== $_SESSION[$name] ? $_SESSION[$name] : false;
    }
    public function __isset($name) {
//        if(isset($_SESSION[$name])){
//            return true;
//        }else{
//             return false;
//        }
        return isset($_SESSION[$name]) ? true : false;
    }

    public function Start(){
        if(empty(session_id())){
            if(session_start()){
                $this->SETSESSIONSTARTTIME();                
                $this->CHECKSESSIONVALID();
            }
        }
    }
    private function SETSESSIONSTARTTIME(){
        if(!isset($this->SSNEWTIME)){
                    $this->SSNEWTIME = time();
                }
        return true;
    }
    private function CHECKSESSIONVALID(){
         if(time() - $this->SSNEWTIME  > ($this->TTL * 60)){
             $this->RENEWSESSION();
             $this->generateFig();
         }
         return true;
     }
    private function RENEWSESSION(){
         $this->SSNEWTIME = time();
         return session_regenerate_id(true);
     }
     
     
//    Kill The Session
     
    public function kill(){
        session_unset();
        setcookie($this->SName, '', $this->SLIFETIME-1000 , $this->SPATH, $this->domain, $this->SSecure, $this->httponly);
        session_destroy();
    }
    private function generateFig(){
        $USERAGENTID = $_SERVER['HTTP_USER_AGENT'];
//        $this->kkey = random_bytes(32);
        $this->kkey = openssl_random_pseudo_bytes(16);
        $ss  = session_id();
        $this->FingPrint = md5($USERAGENTID .$this->kkey. $ss );
    }

    public function ISValidFing(){
        if(!isset($this->FingPrint)){
            $this->generateFig();
        }
        $fingPrint =  md5($_SERVER['HTTP_USER_AGENT'] .$this->kkey. session_id() );
        if($fingPrint === $this->FingPrint){
            return true;
        }
        return false;
    }


    function decrypt($edata, $password) {
        $data = base64_decode($edata);
        $salt = substr($data, 0, 16);
        $ct = substr($data, 16);

        $rounds = 3; // depends on key length
        $data00 = $password.$salt;
        $hash = array();
        $hash[0] = hash('sha256', $data00, true);
        $result = $hash[0];
        for ($i = 1; $i < $rounds; $i++) {
            $hash[$i] = hash('sha256', $hash[$i - 1].$data00, true);
            $result .= $hash[$i];
        }
        $key = substr($result, 0, 32);
        $iv  = substr($result, 32,16);

        return openssl_decrypt($ct, 'AES-256-CBC', $key, true, $iv);
      }   
    function encrypt($data, $password) {
        // Set a random salt
        $salt = openssl_random_pseudo_bytes(16);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
          $dx = hash('sha256', $dx.$password.$salt, true);
          $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
        $encrypted_data = openssl_encrypt($data, 'AES-256-CBC', $key, true, $iv);
        return base64_encode($salt . $encrypted_data);
    } 
    public function read($session_id) {
        
//        return openssl_decrypt(parent::read($id), $this->sessionCipherAlgo, $this->sessionCipherKey);
        
        $data = parent::read($session_id);
        if(!$data){
            return "";
        } else {
            return $this->decrypt($data, $this->key);
        }        
    }
    public function write($session_id, $session_data) {       
        $data = $this->encrypt($session_data, $this->key);
        return parent::write($session_id, $data);
    }

    
}

//
//$session  = new MYSessionHandler();
//$session->Start();
////$_SESSION['msg'] = "THE Data ENCRYPTED";
////$session->emad = "emad rashad";
////var_dump($_SESSION);
////var_dump($session);
////echo date('H:i:s', $session->SSNEWTIME);
////var_dump(time() - $session->SSNEWTIME  > (1 * 60));
////$session->kill();
//if(!$session->ISValidFing()){
//    $session->kill();
//}

