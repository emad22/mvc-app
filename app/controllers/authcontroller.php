<?php
namespace PHPMVC\controllers;

use PHPMVC\models\UserModel;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\helper;
/**
 * Description of IndexController
 *
 * @author emadr
 */
class AuthController extends AbstractController{

    use helper;
    
    public function LoginAction(){
        
        $this->lang->load('auth.login');        
        $this->_template->swapTemp([':view' =>':actionView']);
        
        if(isset($_POST['login'])){
            $isAuthorized = UserModel::authenticate($_POST['username'], $_POST['password'], $this->session);
            if($isAuthorized == 2) {
                $this->messenger->add($this->lang->get('text_user_disabled'), Messenger::APP_MESSEGE_ERROR);
            } elseif ($isAuthorized == 1) {
                $this->redirect('/');
            } elseif ($isAuthorized === false) {
                $this->messenger->add($this->lang->get('text_user_not_found'), Messenger::APP_MESSEGE_ERROR);
            }
        }
        $this->_renderView();
        
    }
    
    public function logoutAction(){
        $this->session->kill();
        $this->redirect('/auth/login');
    }
    
    
}
