<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\models\PrivilegesModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class PrivilegesController extends AbstractController
{
    use InputFilter;
    use Helper;

    private $_createActionRoles =
    [

    ];

    public function defaultAction()
    {
        $this->lang->load('template.common');
        $this->lang->load('privileges.default');

        $this->_data['privileges'] = PrivilegesModel::getAll();

        $this->_renderView();
    }

    // TODO: we need to implement csrf prevention
    public function addAction()
    {
        $this->lang->load('template.common');
//        $this->lang->load('privileges.labels');
        $this->lang->load('privileges.add');

        if(isset($_POST['submit'])) {
//            var_dump($_POST);
            $privilege = new PrivilegesModel();
            
            $privilege->PrivilegeTitle = $this->FilterSTR($_POST['PrivilegeTitle']);
            
            
            $privilege->Privilege  = $this->FilterSTR($_POST['Privilege']);

            if($privilege->save()){
                $this->messenger->add('تم تعديل الصلاحية بنجاح');
                $this->redirect('/privileges');
            }
        }

        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $privilege = PrivilegesModel::getByPK($id);

        if($privilege === false) {
            $this->redirect('/privileges');
        }

        $this->_data['privileges'] = $privilege;

        $this->lang->load('template.common');
//        $this->lang->load('privileges.labels');
        $this->lang->load('privileges.edit');

        if(isset($_POST['submit'])) {
            $privilege->PrivilegeTitle = $this->FilterSTR($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->FilterSTR($_POST['Privilege']);
            if($privilege->save())
            {
                $this->messenger->add('تم تعديل الصلاحية بنجاح');
                $this->redirect('/privileges');
            }
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $privilege = PrivilegesModel::getByPK($id);

        if($privilege === false) {
            $this->redirect('/privileges');
        }

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['PrivilegeId' => $privilege->PrivilegeId]);
        if(false !== $groupPrivileges) {
            foreach ($groupPrivileges as $groupPrivilege) {
                $groupPrivilege->delete();
            }
        }

        if($privilege->delete())
        {
            $this->messenger->add('تم حذف الصلاحية بنجاح');
            $this->redirect('/privileges');
        }
    }

}
