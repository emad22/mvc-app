<?php

namespace PHPMVC\LIB\Template;

trait templatehelper {
    
    public function matchurl($url){
        return parse_url(url: $_SERVER['REQUEST_URI'] , component: PHP_URL_PATH) === $url ;

    }
}
