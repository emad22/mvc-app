<?php
namespace PHPMVC\controllers;
//use PHPMVC\models\UserModel;
use PHPMVC\models\UserGroupModel;
use PHPMVC\models\PrivilegesModel;
use PHPMVC\models\UserGroupPrivilegeModel;
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
        $this->lang->load('template.common');
        $this->lang->load('usersgroups.default');
        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_renderView();
        
    }
    
    public function addAction(){
        $this->lang->load('template.common');
        $this->lang->load('usersgroups.add');
        $this->_data['privileges'] = PrivilegesModel::getAll();               
        
        if(isset($_POST['submit'])){
            
            $group = new UserGroupModel();           
            $group->GroupName      = $this->FilterSTR($_POST['groupName']);
            if($group->save()){
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])){
                    foreach ($_POST['privileges'] as $privilegeId){
                        $groupprivilege = new UserGroupPrivilegeModel();
                        $groupprivilege->GroupId = $group->GroupId;
                        $groupprivilege->PrivilegeId = $privilegeId;
                        $groupprivilege->save(); 
                    }
                }
                $this->messenger->add('تم حفظ الصلاحيات  بنجاح');
                $this->redirect('/usersgroups/default');
            }
        }
        
       
        $this->_renderView();
    }
    
    
    public function editAction(){   
        $this->lang->load('template.common');
        $this->lang->load('usersgroups.edit');
         $id = $this->FilterInt($this->_params[0]);
         $usersgroup= UserGroupModel::getByPK($id);
         if($usersgroup == null){
             $this->redirect('/usersgroups/default');
         }
         $this->_data['privileges'] = PrivilegesModel::getAll();
         $this->_data['groups'] = $usersgroup;
         
         $groupPrivileges = UserGroupPrivilegeModel::getBy(['GroupId'=>$usersgroup->GroupId]);
         $extractPrivligeId = []; 
         if( false!== $groupPrivileges ){
             foreach ($groupPrivileges as $privilege){
                 $extractPrivligeId[] = $privilege->PrivilegeId;
             }
         }
         $this->_data['groupPrivileges'] = $extractPrivligeId;
        if(isset($_POST['submit'])){
            $usersgroup->GroupName      = $this->FilterSTR($_POST['groupName']);
            if($usersgroup->save()){
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])){
                    $privilegewillDeleted = array_diff($extractPrivligeId , $_POST['privileges']);
                    $privilegewillAdded   = array_diff( $_POST['privileges'] , $extractPrivligeId);
                    foreach ($privilegewillDeleted as $deletedPrivilege){
                        $willdelete = UserGroupPrivilegeModel::getBy(['PrivilegeId'=>$deletedPrivilege , 'GroupId'=>$usersgroup->GroupId]);
                        $willdelete->current()->delete();
                    }             
                    foreach ($privilegewillAdded as $addedPrivilege){
                        $groupprivilege = new UserGroupPrivilegeModel();
                        $groupprivilege->GroupId = $usersgroup->GroupId;
                        $groupprivilege->PrivilegeId = $addedPrivilege;
                        $groupprivilege->save(); 
                    }
                }
                $this->redirect('/usersgroups/default');
            }
        }  
        $this->_renderView();
    } 
    public function deleteAction(){
         $id = $this->FilterInt($this->_params[0]);
//         var_dump($id);
         $group = UserGroupModel::getByPK($id);
         $groupPrivileges = UserGroupPrivilegeModel::getBy(['GroupId'=>$group->GroupId]);
         if($groupPrivileges !==false){
             foreach ($groupPrivileges as $groupPrivilege){
                 $groupPrivilege->delete();
             }
            }
            if($group->delete()){
                $this->redirect('/usersgroups/default');
            }
    }
    
    
}
