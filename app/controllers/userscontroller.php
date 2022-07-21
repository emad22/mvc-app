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
    
    private $_createActionRoles =
    [
//        'FirstName'     => 'req|alpha|between(3,10)',
//        'LastName'      => 'req|alpha|between(3,10)',
        'Username'      => 'req|alphanum|between(3,12)',
        'Password'      => 'req|min(6)|eq_field(CPassword)',
        'CPassword'     => 'req|min(6)',
        'Email'         => 'req|email|eq_field(CEmail)',
        'CEmail'        => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'GroupId'       => 'req|int'
    ];
    public function DefaultAction(){
        $this->lang->load('template.common');
        $this->lang->load('users.default');
        $this->_data['users'] = UserModel::getAll();
        $this->_renderView();
        
    }
    
    public function addAction(){
        $this->lang->load('template.common');
        $this->lang->load('users.add');
        $this->_data['groups'] = UserGroupModel::getAll();
        if(isset($_POST['submit'])){
            
            $user = new UserModel();
            
            $user->Username      = $this->FilterSTR($_POST['username']);
            $user->encypass($this->FilterSTR($_POST['password']));
            $user->Email             = $this->FilterSTR($_POST['email']);
            $user->PhoneNumber       = $this->FilterInt($_POST['phone']);
            $user->SubscriptionDate  = date('Y-m-d');
            $user->LastLogin         = date('Y-m-d H:i:s');
            $user->GroupId           = $this->FilterInt($_POST['usergroup']);
            $user->Status            = 1;
            
//            var_dump($user);         
            if($user->save()){
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
                $this->redirect('/users/default');
            }
    }
    
    
}
