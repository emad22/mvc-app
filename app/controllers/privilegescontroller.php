<?php
namespace PHPMVC\controllers;
//use PHPMVC\models\UserModel;
use PHPMVC\models\PrivilegesModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\helper;
/**
 * Description of IndexController
 *
 * @author emadr
 */
class PrivilegesController extends AbstractController{
    use InputFilter;
    use helper;
    
    public function DefaultAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('privileges.default');
        $this->_data['privileges'] = PrivilegesModel::getAll();
        $this->_renderView();
        
    }
    
    public function addAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('privileges.add');
               
        if(isset($_POST['submit'])){
            $privilege = new PrivilegesModel();            
            $privilege->privilege          = $this->FilterSTR($_POST['privilege']);
            $privilege->PrivilegeTitle     = $this->FilterSTR($_POST['PrivilegeTitle']);               
            if($privilege->save()){
                $this->redirect('/privileges/default');
            }
        }
        $this->_renderView();
    }
    public function editAction(){   
        $this->_lang->load('template.common');
        $this->_lang->load('privileges.edit');
         $id = $this->FilterInt($this->_params[0]);
//         var_dump($id);
         $privilege = PrivilegesModel::getByPK($id);
         if($privilege == null){
             $this->redirect('/privileges/default');
         }
         $this->_data['privileges'] = $privilege;
//         var_dump($emp);
        if(isset($_POST['submit'])){
            $privilege->privilege          = $this->FilterSTR($_POST['privilege']);
            $privilege->PrivilegeTitle     = $this->FilterSTR($_POST['PrivilegeTitle']);     
            
            if($privilege->save()){
                $this->redirect('/privileges/default');
            }
        }
        $this->_renderView();
    }
    
    
    
    
    public function deleteAction(){
        $this->_lang->load('template.common');
        $this->_lang->load('privileges.edit');
         $id = $this->FilterInt($this->_params[0]);
//         var_dump($id);
         $privilege = PrivilegesModel::getByPK($id);
         if($privilege->delete()){
                $this->redirect('/privileges/default');
            }
    }
    
    
}
