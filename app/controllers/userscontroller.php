<?php
namespace PHPMVC\controllers;
use PHPMVC\models\UserModel;
use PHPMVC\models\UserGroupModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\helper;
/**
 * Description of IndexController
 *
 * @author emadr
 */
class UsersController extends AbstractController{
    use InputFilter;
    use helper;
    public function DefaultAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('users.default');
        $this->_data['users'] = UserModel::getAll();
        $this->_renderView();
        
    }
    
    public function addAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('users.add');
        $this->_data['groups'] = UserGroupModel::getAll();
        
        if(isset($_POST['submit'])){
            $user = new UserModel();
            
            $user->userName      = $this->FilterSTR($_POST['username']);
            $user->password      = sha1($this->FilterSTR($_POST['password']));
            $user->email         = $this->FilterSTR($_POST['email']);
            $user->phoneNumber   = $this->FilterInt($_POST['phone']);
            $user->subscribtion  = date('Y-m-d');
            $user->lastLogin     = date('Y-m-d H:i:s');
            $user->groupId       = $this->FilterInt($_POST['usergroup']);
            
//            var_dump(date('Y-m-d H:i:s'));
            
            if($user->save()){
                $_SESSION['message'] = 'Employees Save Successfuly' ;
                $this->redirect('/users/default');
            }
        }
        $this->_renderView();
    }
    
    public function deleteAction(){

         $id = $this->FilterInt($this->_params[0]);
         var_dump($id);
         $user = UserModel::getByPK($id);
         if($user == null){
             $this->redirect('/users/default');
         }
         $this->_data['user'] = $user;
//         var_dump($emp);
         if($user->delete()){
                $_SESSION['message'] = 'user deleted Successfuly' ;
                $this->redirect('/users/default');
            }
    }
    
    
}
