<?php
namespace PHPMVC\controllers;
use PHPMVC\models\UserModel;
use PHPMVC\models\UserGroupModel;
use PHPMVC\models\UserProfileModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\helper;
use PHPMVC\LIB\Validate;
/**
 * Description of IndexController
 *
 * @author emadr
 */
class UsersController extends AbstractController{
    use InputFilter;
    use helper;
    use Validate;
    
    
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
        $this->lang->load('users.messages');
        $this->lang->load('labels.label');
        $this->lang->load('validation.errors');
        
        $this->_data['groups'] = UserGroupModel::getAll();
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $user = new UserModel();
            
            $user->Username      = $this->FilterSTR($_POST['Username']);
            $user->encypass($this->FilterSTR($_POST['Password']));
            $user->Email             = $this->FilterSTR($_POST['Email']);
            $user->PhoneNumber       = $this->FilterInt($_POST['PhoneNumber']);
            $user->SubscriptionDate  = date('Y-m-d');
            $user->LastLogin         = date('Y-m-d H:i:s');
            $user->GroupId           = $this->FilterInt($_POST['GroupId']);
            $user->Status            = 1;
            
//            var_dump($user);         
            if(UserModel::userExists($user->Username)) {
                $this->messenger->add($this->lang->get('message_user_exists'), \PHPMVC\LIB\Messenger::APP_MESSEGE_ERROR);
                $this->redirect('/users');
            }
            
            if($user->save()){
                $userProfile = new UserProfileModel();
                $userProfile->UserId = $user->UserId;
                $userProfile->FirstName = $this->FilterSTR($_POST['FirstName']);
                $userProfile->LastName = $this->FilterSTR($_POST['LastName']);
                $userProfile->save(false);
                $this->messenger->add($this->lang->get('message_create_success'));         
            }else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSEGE_ERROR);
            }
            $this->redirect('/users/default');
        }
        $this->_renderView();
    }
    
    public function deleteAction(){
        $this->lang->load('users.messages');

         $id = $this->FilterInt($this->_params[0]);
         var_dump($id);
         $user = UserModel::getByPK($id);
         if($user == null){
             $this->redirect('/users/default');
         }
         $this->_data['user'] = $user;
//         var_dump($emp);
         if($user->delete()){   
             $this->messenger->add($this->lang->get('message_delete_success'));
         }else{
                $this->messenger->add($this->lang->get('message_delete_failed') , \PHPMVC\LIB\Messenger::APP_MESSEGE_ERROR);
            }
                $this->redirect('/users/default');
    }   

    public function checkUserExistsAjaxAction()
    {
        if(isset($_POST['Username']) && !empty($_POST['Username'])) {
            header('Content-type: text/plain');
            if(UserModel::userExists($this->filterString($_POST['Username'])) !== false) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }
    
}
