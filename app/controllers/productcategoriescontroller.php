<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Fileupload;
//use PHPMVC\LIB\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Lib\Validate;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\ProductCategoryModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class ProductCategoriesController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
    [
        'Name'          => 'req|alphanum|between(3,30)'
    ];

    public function defaultAction()
    {
        $this->lang->load('template.common');
        $this->lang->load('productcategories.default');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $this->_renderView();
    }

    public function createAction()
    {
        $this->lang->load('template.common');
        $this->lang->load('productcategories.create');
        $this->lang->load('productcategories.labels');
        $this->lang->load('productcategories.messages');
        $this->lang->load('validation.errors');

        $uploadError = false;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $category = new ProductCategoryModel();
            $category->Name = $this->FilterSTR($_POST['Name']);

            
            if(!empty($_FILES['image']['name'])) {
                $uploader = new FileUpload($_FILES['image']);
//                var_dump($uploader);
                try {
                    $uploader->upload();
                    $category->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSEGE_ERROR);
                    $uploadError = true;
                }
            }
//            var_dump($uploadError);
            if($uploadError === false && $category->save())
            {
                $this->messenger->add($this->lang->get('message_create_success'));
                $this->redirect('/productcategories');
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), Messenger::APP_MESSEGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->lang->load('template.common');
        $this->lang->load('productcategories.edit');
        $this->lang->load('productcategories.labels');
        $this->lang->load('productcategories.messages');
        $this->lang->load('validation.errors');


        $this->_data['category'] = $category;
        $uploadError = false;

        if(isset($_POST['submit'])) {
            $category->Name = $this->FilterSTR($_POST['Name']);
            if(!empty($_FILES['image']['name'])) {
                // Remove the old image
                if($category->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$category->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$category->Image);
                }
                // Create a new image
                $uploader = new FileUpload($_FILES['image']);
                try {
                    $uploader->upload();
                    $category->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $category->save())
            {
                $this->messenger->add($this->lang->get('message_create_success'));
                $this->redirect('/productcategories');
            } else {
                $this->messenger->add($this->lang->get('message_create_failed'), messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_renderView();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->lang->load('productcategories.messages');

        if($category->delete())
        {
            // Remove the old image
            if($category->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$category->Image)) {
                unlink(IMAGES_UPLOAD_STORAGE.DS.$category->Image);
            }
            $this->messenger->add($this->lang->get('message_delete_success'));
        } else {
            $this->messenger->add($this->lang->get('message_delete_failed'));
        }
        $this->redirect('/productcategories');
    }
}
