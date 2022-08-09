<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\lib\messenger;
use PHPMVC\Models\SupplierModel;
use PHPMVC\LIB\Validate;

class SuppliersController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
    [
        'Name'          => 'req|alpha|between(3,40)',
        'Email'         => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'Address'       => 'req|alphanum|max(50)'
    ];

    public function defaultAction()
    {
        $this->lang->load('template.common');
        $this->lang->load('suppliers.default');

        $this->_data['suppliers'] = SupplierModel::getAll();

        $this->_renderView();
    }

    public function addAction()
    {

        $this->lang->load('template.common');
        $this->lang->load('suppliers.add');
        $this->lang->load('suppliers.labels');
        $this->lang->load('suppliers.messages');
        $this->lang->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $supplier = new SupplierModel();

            $supplier->Name = $this->FilterSTR($_POST['Name']);
            $supplier->Email = $this->FilterSTR($_POST['Email']);
            $supplier->PhoneNumber = $this->FilterSTR($_POST['PhoneNumber']);
            $supplier->Address = $this->FilterSTR($_POST['Address']);

            if($supplier->save()) {
                $this->messenger->add($this->lang->get('message_create_success'));
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers');
        }

        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($id);

        if($supplier === false) {
            $this->redirect('/suppliers');
        }

        $this->_data['supplier'] = $supplier;

        $this->lang->load('template.common');
        $this->lang->load('suppliers.edit');
        $this->lang->load('suppliers.labels');
        $this->lang->load('suppliers.messages');
        $this->lang->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $supplier->Name = $this->FilterSTR($_POST['Name']);
            $supplier->Email = $this->FilterSTR($_POST['Email']);
            $supplier->PhoneNumber = $this->FilterSTR($_POST['PhoneNumber']);
            $supplier->Address = $this->FilterSTR($_POST['Address']);

            if($supplier->save()) {
                $this->messenger->add($this->lang->get('message_create_success'));
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers');
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($id);

        if($supplier === false) {
            $this->redirect('/suppliers');
        }

        $this->lang->load('suppliers.messages');

        if($supplier->delete()) {
            $this->messenger->add($this->lang->get('message_delete_success'));
        } else {
            $this->messenger->add($this->lang->get('message_delete_failed'), messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/suppliers');
    }
}
