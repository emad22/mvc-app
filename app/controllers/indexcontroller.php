<?php
namespace PHPMVC\controllers;

/**
 * Description of IndexController
 *
 * @author emadr
 */
class IndexController extends AbstractController{
    
    
    public function DefaultAction(){
        unset($this->session->messages);
//        var_dump($this->session->messages);
//        $this->messenger->add('Welcome Here');
        $this->lang->load('template.common');
        $this->lang->load('index.default');
        $this->_renderView();
    }
    
    public function addAction(){
        $this->_renderView();
    }
}
