<?php
namespace PHPMVC\controllers;
use PHPMVC\LIB\validate;
use PHPMVC\models\UserGroupPrivilegeModel;
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
//        var_dump(\PHPMVC\models\UserModel::getModelTableName());
        
//        $privilege = UserGroupPrivilegeModel::getPrivilegesForGroup( $this->session->u->GroupId);
//        echo '<pre>';
//        var_dump($privilege);
//        echo '</pre>';
//        var_dump($this->between('عماد' , 3 , 5));
//        var_dump($this->req('عماد'));
//        var_dump($this->alpha('عماد'));
        
//        $str =  '%s يجب ان لا يترك فارغا';
//        $newstr = sprintf($str, 'اسم المستخدم');
//        echo $newstr;

        $this->_renderView();
    }
    
    public function addAction(){
        $this->_renderView();
    }
}
