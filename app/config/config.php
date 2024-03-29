<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('APP_PATH', dirname(realpath(__FILE__)). DS .'..' . DS);
//define('APP_PATH', realpath (dirname(__FILE__)). DS .'..' . DS);

//var_dump(APP_PATH);
define('VIEWS_PATH', APP_PATH .  'views' . DS);
//var_dump(VIEWS_PATH);

//define('TEMPLATE_PATH', 'http://www.mvc-app.net/');

//C:\xampp\htdocs\mvc-app\app\config\..\template\
define('TEMPLATE_PATH', APP_PATH .  'template' . DS);
//var_dump(TEMPLATE_PATH);
define('LANG_PATH', APP_PATH .  'lang' . DS);

//define('CSS', APP_PATH   .'..' . DS . 'public' . DS .  'dist'. DS );
//var_dump(CSS);
//define('JS', APP_PATH   .'..' . DS . 'public' . DS . 'dist'. DS .'js' . DS);

define('CSS', '/css/');
define('JS', '/js/');

//SESSION
defined('SESSION_NAME') ? null : define('SESSION_NAME' ,'_ESTORE_NAME') ;
defined( 'SESSION_LIFE_TIME') ? null : define('SESSION_LIFE_TIME' ,0) ;
defined('SESSION_SAVE_PATH') ? null : define('SESSION_SAVE_PATH' , APP_PATH . '..' . DS .'sessions') ;
//var_dump(SESSION_SAVE_PATH);

// Database Credentials
defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USERNAME')       ? null : define ('DATABASE_USERNAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', '');
defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'estoredb');
defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);

///Language 
defined('APP_DEFAULT_LANG')     ? null : define ('APP_DEFAULT_LANG', 'ar');
// SALT
defined('APP_SALT')     ? null : define ('APP_SALT', '$2a$07$yeNCSNwRpYopOhv0TrrReP$');
// Check for access privileges
defined('CHECK_FOR_PRIVILEGES') ? null : define('CHECK_FOR_PRIVILEGES', 1); // to prevent the page access change to 1

// define the path to our uploaded files
//defined('SESSION_SAVE_PATH') ? null : define('SESSION_SAVE_PATH' , APP_PATH . '..' . DS .'sessions') ;
defined('UPLOAD_STORAGE')     ? null : define ('UPLOAD_STORAGE', APP_PATH .  '..' . DS . 'public' . DS . 'uploads');
//var_dump(UPLOAD_STORAGE);
//define('UPLOAD_STORAGE', '/uploads');


defined('IMAGES_UPLOAD_STORAGE')     ? null : define ('IMAGES_UPLOAD_STORAGE', UPLOAD_STORAGE . DS . 'images');
defined('DOCUMENTS_UPLOAD_STORAGE')     ? null : define ('DOCUMENTS_UPLOAD_STORAGE', UPLOAD_STORAGE . DS . 'documents');
defined('MAX_FILE_SIZE_ALLOWED')     ? null : define ('MAX_FILE_SIZE_ALLOWED', ini_get('upload_max_filesize'));
