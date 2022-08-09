<?php

namespace PHPMVC;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Template\Template;
use PHPMVC\LIB\MYSessionHandler;
use PHPMVC\LIB\Language;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Auth;



if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
require_once '..' . DS . 'app' . DS .'config' . DS .'config.php';
require_once APP_PATH . DS . 'lib'.DS. 'autoload.php';

$templateparts = require_once '..' . DS . 'app' . DS .'config' . DS .'templateconfig.php';


$session  = new MYSessionHandler();
$lang = new Language();
$template = new Template($templateparts);


$session->Start();


if(!isset($session->lang)){
    $session->lang = APP_DEFAULT_LANG;
}



$registry  = Registry::getinstance();
$auth  = Auth::getinstance($session);
$messenger = Messenger::getinstance($session);

$registry->session = $session;
$registry->lang = $lang;
$registry->messenger = $messenger;

$front =  new FrontController($template , $registry , $auth);
$front->Dispatch();
