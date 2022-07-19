<?php
namespace PHPMVC\LIB;

class Registry {
    private static $_instance;
    private function __construct() {}
    private function clone(){}
    public static function getinstance() {
        if(self::$_instance  === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }  
    public function __set($key, $object) {
        $this->$key = $object;
    }
    public function __get($key) {
        return $this->$key;
    }

}
