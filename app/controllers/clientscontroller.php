<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\ClientModel;
use PHPMVC\LIB\Validate;

class ClientsController extends AbstractController
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

    public function defaultAction(){
        $this->lang->load('template.common');
        $this->lang->load('clients.default');

        $this->_data['clients'] = ClientModel::getAll();

        $this->_renderView();
    }

    public function addAction(){

        $this->lang->load('template.common');
        $this->lang->load('clients.add');
        $this->lang->load('clients.labels');
        $this->lang->load('clients.messages');
        $this->lang->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client = new ClientModel();

            $client->Name = $this->FilterSTR($_POST['Name']);
            $client->Email = $this->FilterSTR($_POST['Email']);
            $client->PhoneNumber = $this->FilterSTR($_POST['PhoneNumber']);
            $client->Address = $this->FilterSTR($_POST['Address']);

            if($client->save()) {
                $this->messenger->add($this->lang->get('message_create_success'));
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client === false) {
            $this->redirect('/clients');
        }

        $this->_data['client'] = $client;

        $this->lang->load('template.common');
        $this->lang->load('clients.edit');
        $this->lang->load('clients.labels');
        $this->lang->load('clients.messages');
        $this->lang->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client->Name = $this->FilterSTR($_POST['Name']);
            $client->Email = $this->FilterSTR($_POST['Email']);
            $client->PhoneNumber = $this->FilterSTR($_POST['PhoneNumber']);
            $client->Address = $this->FilterSTR($_POST['Address']);

            if($client->save()) {
                $this->messenger->add($this->lang->get('message_create_success'));
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client === false) {
            $this->redirect('/clients');
        }

        $this->lang->load('clients.messages');

        if($client->delete()) {
            $this->messenger->add($this->lang->get('message_delete_success'));
        } else {
            $this->messenger->add($this->lang->get('message_delete_failed'), messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/clients');
    }
}
