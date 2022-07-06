<?php
namespace PHPMVC\controllers;

/**
 * Description of IndexController
 *
 * @author emadr
 */
class IndexController extends AbstractController{
    
    
    public function DefaultAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('index.default');
        $this->_renderView();
    }
    
    public function addAction(){
        $this->_renderView();
    }
}
