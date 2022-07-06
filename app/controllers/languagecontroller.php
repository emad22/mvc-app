<?php
namespace PHPMVC\controllers;
use PHPMVC\LIB\helper;
/**
 * Description of LanguageController
 *
 * @author emadr
 */
class LanguageController extends AbstractController{
    use helper;
    
    public function DefaultAction(){
        
        if($_SESSION['lang'] == 'ar'){
            
//            var_dump($_SESSION['lang']);
            $_SESSION['lang'] = 'en';
        }else{
            $_SESSION['lang'] = 'ar';
        }
//        var_dump($_SESSION['lang']);exit;
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    
}
