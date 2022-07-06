<?php
namespace PHPMVC\LIB;

class AutoLoad{
    
    
    public static function autolaod($className) {
//        var_dump($className);
        
//        $className = str_replace('\/', '\\', $className ); //for other operationg systems
        $className = str_replace('PHPMVC', '', $className ); // \LIB\Template
//        var_dump($className);
        $className = strtolower($className);  // \lib\template
//        var_dump($className);
        $className = $className.'.php'; // \lib\template.php
//        var_dump($className);
        if(file_exists(APP_PATH . $className)){
            require APP_PATH .  $className;
        }
    }
}
spl_autoload_register(__NAMESPACE__ .'\AutoLoad::autolaod');
