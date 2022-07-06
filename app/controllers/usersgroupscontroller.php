<?php
namespace PHPMVC\controllers;
//use PHPMVC\models\UserModel;
use PHPMVC\models\UserGroupModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\helper;
/**
 * Description of IndexController
 *
 * @author emadr
 */
class UsersGroupsController extends AbstractController{
    use InputFilter;
    use helper;
    public function DefaultAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('usersgroups.default');
        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_renderView();
        
    }
    
    public function addAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('usersgroups.add');
               
        if(isset($_POST['submit'])){
            $group = new UserGroupModel();
            
            $group->groupName      = $this->FilterSTR($_POST['groupName']);
                        
            
            if($group->save()){
                $_SESSION['message'] = 'Employees Save Successfuly' ;
                $this->redirect('/usersgroups/default');
            }
        }
        
       
        $this->_renderView();
    }
    
    
    
    
    public function deleteAction(){
        
    }
    
    
}
