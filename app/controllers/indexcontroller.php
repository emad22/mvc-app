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
    
        $this->lang->load('template.common');
        $this->lang->load('index.default');
        
        $str =  '%s يجب ان لا يترك فارغا';
        $newstr = sprintf($str, 'اسم المستخدم');
        echo $newstr;

        $this->_renderView();
    }
    
    public function addAction(){
        $this->_renderView();
    }
}
