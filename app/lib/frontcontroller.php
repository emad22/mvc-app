<?php
namespace PHPMVC\LIB;
use PHPMVC\LIB\Template\Template;

/**
 * Description of frontController
 *
 * @author emadr
 */
class FrontController {
    //put your code here
    
    const NOT_FOUND_ACTION = 'notFoundAction';
    const NOT_FOUND_CONTROLLER = 'PHPMVC\controllers\\Notfoundcontroller';
    
    
    private $_controller = 'index';
    private $_action  ='default';
    private $_params = array();
    
    private $_template;
//    private $_lang;
    private $_registry;
//    private $_sitename;
    
    public function __construct(Template $template , Registry $registry) {
        
        $this->_template = $template; 
        $this->_registry  = $registry;
        $this->__Parseulr();
         
    }
    private function __Parseulr(){
        
        $url = parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH); // get url like  /mvc-app/publi/index/test
        $url= str_replace('mvc-app/public', '', $url); // for loaclhost
        $url= trim($url, '/'); // remove / from url         
        $url= explode('/', $url,3);
        if(isset($url[0]) && $url[0] !==''){
            $this->_controller =$url[0];
        }
        if(isset($url[1]) && $url[1] !==''){
            $this->_action =$url[1];
        }
        if(isset($url[2]) && $url[2] !==''){
            $this->_params =explode('/', $url[2]);
        }

    }
    
    public function Dispatch(){
        
        $controllerName = 'PHPMVC\controllers\\'.ucfirst($this->_controller) . 'Controller';
        $actionName = $this->_action . 'Action';
        
//        var_dump($controllerName , $actionName);
//        if(!class_exists($controllerName)){
//            $controllerName = self::NOT_FOUND_CONTROLLER;
//        }
        
        if(!class_exists($controllerName) || !method_exists($controllerName , $actionName)){
            $controllerName = self::NOT_FOUND_CONTROLLER;
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }
        $controller = new $controllerName();  
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setRegistry($this->_registry);
        $controller->$actionName();
    }
}
