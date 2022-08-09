<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Validate;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\ProductCategoryModel;
use PHPMVC\Models\ProductModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class ProductListController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
    [
        'CategoryId'    => 'req|num',
        'Name'          => 'req|alphanum|between(3,50)',
        'Quantity'      => 'req|num',
        'BuyPrice'      => 'req|num',
        'SellPrice'     => 'req|num',
        'Unit'          => 'req|num'
    ];

    public function defaultAction()
    {
        $this->lang->load('template.common');
        $this->lang->load('productlist.default');

        $this->_data['products'] = ProductModel::getAll();

        $this->_renderView();
    }

    public function createAction()
    {
        $this->lang->load('template.common');
        $this->lang->load('productlist.create');
        $this->lang->load('productlist.labels');
        $this->lang->load('productlist.messages');
        $this->lang->load('productlist.units');
        $this->lang->load('validation.errors');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $uploadError = false;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $product = new ProductModel();
            $product->Name = $this->FilterSTR($_POST['Name']);
            $product->CategoryId = $this->FilterInt($_POST['CategoryId']);
            $product->Quantity = $this->FilterInt($_POST['Quantity']);
            $product->BuyPrice = $this->FilterFLOAT($_POST['BuyPrice']);
            $product->SellPrice = $this->FilterFLOAT($_POST['SellPrice']);
            $product->Unit = $this->FilterInt($_POST['Unit']);

            if(!empty($_FILES['image']['name'])) {
                $uploader = new FileUpload($_FILES['image']);
                try {
                    $uploader->upload();
                    $product->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSEGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $product->save())
            {
                $this->messenger->add($this->lang->get('message_create_success'));
                
                $this->redirect('/productlist');
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSEGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->FilterInt($this->_params[0]);
        $product = ProductModel::getByPK($id);

        if($product === false) {
            $this->redirect('/productlist');
        }

        $this->lang->load('template.common');
        $this->lang->load('productlist.edit');
        $this->lang->load('productlist.labels');
        $this->lang->load('productlist.messages');
        $this->lang->load('productlist.units');
        $this->lang->load('validation.errors');


        $this->_data['product'] = $product;
        $this->_data['categories'] = ProductCategoryModel::getAll();
        $uploadError = false;

        if(isset($_POST['submit'])) {

            $product->Name = $this->FilterSTR($_POST['Name']);
            $product->CategoryId = $this->FilterInt($_POST['CategoryId']);
            $product->Quantity = $this->FilterInt($_POST['Quantity']);
            $product->BuyPrice = $this->FilterFLOAT($_POST['BuyPrice']);
            $product->SellPrice = $this->FilterFLOAT($_POST['SellPrice']);
            $product->Unit = $this->FilterInt($_POST['Unit']);

            if(!empty($_FILES['image']['name'])) {
                // Remove the old image
                if($product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$product->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$product->Image);
                }
                // Create a new image
                $uploader = new FileUpload($_FILES['image']);
                try {
                    $uploader->upload();
                    $product->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), messenger::APP_MESSEGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $product->save())
            {
                $this->messenger->add($this->lang->get('message_create_success'));
                $this->redirect('/productlist');
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSEGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->FilterInt($this->_params[0]);
        $product = ProductModel::getByPK($id);

        if($product === false) {
            $this->redirect('/productlist');
        }

        $this->lang->load('productlist.messages');

        if($product->delete())
        {
            // Remove the old image
            if($product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$product->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                unlink(IMAGES_UPLOAD_STORAGE.DS.$product->Image);
            }
            $this->messenger->add($this->lang->get('message_delete_success'));
        } else {
            $this->messenger->add($this->lang->get('message_delete_failed'));
        }
        $this->redirect('/productlist');
    }
}
