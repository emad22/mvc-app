<?php
namespace PHPMVC\controllers;

/**
 * Description of AbstractController
 *
 * @author emadr
 */
class AbstractController {
    
    protected $_controller ;
    protected $_action  ;
    protected $_params ;
    
    protected $_template;
    protected $_data =  [];

    public function notFoundAction(){
        $this->_renderView();
    }
    public function setController($controllerName){
        $this->_controller = $controllerName;
    }
    public function setTemplate($template){
        $this->_template = $template;
    }
    public function setAction($actionName){
        $this->_action = $actionName;
    }
    public function setParams($params){
        $this->_params = $params;
    } 
    protected function _renderView(){
        if($this->_action  == \PHPMVC\LIB\FrontController::NOT_FOUND_ACTION){
            require_once VIEWS_PATH . 'notfound' .DS. 'notfound.view.php';
        }else {
            $view =  VIEWS_PATH . $this->_controller .DS. $this->_action .'.view.php';
            if(file_exists($view)){
//                extract($this->_data);
                
                $this->_template->setActionViewFile($view);
                $this->_template->setAppData($this->_data);
//                var_dump($this->_template);
//                require_once TEMPLATE_PATH . 'templateStart.php';                
//                require_once TEMPLATE_PATH . 'wrapperStart.php';
//                require_once TEMPLATE_PATH . 'header.php';
//                require_once TEMPLATE_PATH . 'navbar.php';
//                require_once $view;
//                require_once TEMPLATE_PATH . 'wrapperEnd.php';
//                require_once TEMPLATE_PATH . 'templateEnd.php';
//                $this->_template->setAppData($this->_data);
//                $this->_template->setActionViewFile($view);
                
//                $this->_template->RenderApp();
                
            } else {
                require_once VIEWS_PATH . 'notfound' .DS. 'notview.view.php';
            }
        }
        
    }
}
