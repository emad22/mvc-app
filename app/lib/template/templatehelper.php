<?php

namespace PHPMVC\LIB\Template;

trait templatehelper {
    
    public function matchurl($url){
        return parse_url(url: $_SERVER['REQUEST_URI'] , component: PHP_URL_PATH) === $url ;

    }
    
    public function showValue($fieldName, $object = null)
    {
        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : (is_null($object) ? '' : $object->$fieldName);
    }
    
    public function selectedIf($fieldName, $value, $object = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'selected' : '';
    }
}
