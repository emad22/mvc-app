<?php

namespace PHPMVC;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Template\Template;
use PHPMVC\LIB\MYSessionHandler;
use PHPMVC\LIB\Language;


if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
require_once '..' . DS . 'app' . DS .'config' . DS .'config.php';
require_once APP_PATH . DS . 'lib'.DS. 'autoload.php';

$templateparts = require_once '..' . DS . 'app' . DS .'config' . DS .'templateconfig.php';


$session  = new MYSessionHandler();
$session->Start();

if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = APP_DEFAULT_LANG;
}
$template = new Template($templateparts);
$lang = new Language();

$front =  new FrontController($template , $lang);
$front->Dispatch();
