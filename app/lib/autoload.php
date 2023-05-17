<?php
namespace PHPMVC\LIB;

class AutoLoad{
    
    
    public static function autolaod($className) {
//        echo ($className);
        
//for other operationg systems
//        $className = str_replace('\/', '\\', $className ); 

// remove main space
        $className = str_replace('PHPMVC', '', $className ); // \LIB\Template
//        var_dump($className);
// convert from \LIB\Template  \lib\template
        $className = strtolower($className);  // \lib\template
//        var_dump($className);
// add .php
        $className = $className.'.php'; // \lib\template.php
//        var_dump($className);
// var_dump(APP_PATH .  $className);
        if(file_exists(APP_PATH . $className)){
            require APP_PATH .  $className;
        }
    }
}
spl_autoload_register(__NAMESPACE__ .'\AutoLoad::autolaod');
