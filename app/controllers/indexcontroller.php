<?php
namespace PHPMVC\controllers;
use PHPMVC\LIB\validate;
/**
 * Description of IndexController
 *
 * @author emadr
 */
class IndexController extends AbstractController{
    
    use Validate;
    
    public function DefaultAction(){
        
//        unset($this->session->messages);
//        var_dump($this->session->messages);
//        $this->messenger->add('Welcome Here');
        $this->lang->load('template.common');
        $this->lang->load('index.default');
//        var_dump(mb_strlen('عماد'));
        var_dump($this->url('http://www.mvc-app.net/'));
        $this->_renderView();
    }
    
    public function addAction(){
        $this->_renderView();
    }
}
