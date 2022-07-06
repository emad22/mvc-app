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
    protected $_lang;
    
    protected $_data =  [];

    public function notFoundAction(){
        $this->_lang->load('template.common');
        $this->_renderView();
    }
    public function setController($controllerName){
        $this->_controller = $controllerName;
    }
    public function setTemplate($template){
        $this->_template = $template;
    }
    public function setLang($lang){
        $this->_lang = $lang;
    }
    public function setAction($actionName){
        $this->_action = $actionName;
    }
    public function setParams($params){
        $this->_params = $params;
    } 
    protected function _renderView(){
        $view =  VIEWS_PATH . $this->_controller .DS. $this->_action .'.view.php';
        if($this->_action  == \PHPMVC\LIB\FrontController::NOT_FOUND_ACTION || !file_exists($view)){
            $view = VIEWS_PATH . 'notfound' .DS. 'notfound.view.php';
        }
   
            $this->_data = array_merge($this->_data, $this->_lang->getDictionary());             
            $this->_template->setActionViewFile($view);
            $this->_template->setAppData($this->_data);
            $this->_template->RenderApp();

        
    }
}
