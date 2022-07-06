<?php
namespace PHPMVC\controllers;
use PHPMVC\models\EmployeeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\helper;

class EmployeeController  extends AbstractController{
    
    use InputFilter;
    use helper;
    
    public function DefaultAction(){
        
//        var_dump($this->_lang);
        $this->_lang->load('template.common');
        $this->_lang->load('employee.default');
        $this->_data['employees'] = EmployeeModel::getAll();
        $this->_renderView();
    }
    
    public function addAction(){   
        
        $this->_lang->load('template.common');
        $this->_lang->load('employee.add');
        
        if(isset($_POST['submit'])){
            $emp = new EmployeeModel();
            
            $emp->name = $this->FilterSTR($_POST['name']);
            $emp->address = $this->FilterSTR($_POST['address']);
            $emp->type    = $this->FilterSTR($_POST['type']);
            $emp->age = $this->FilterInt($_POST['age']);
            $emp->salary = $this->FilterFLOAT($_POST['salary']);
            $emp->tax = $this->FilterFLOAT($_POST['tax']);
            
            if($emp->save()){
                $_SESSION['message'] = 'Employees Save Successfuly' ;
                $this->redirect('/employee/default');
            }
        }
        $this->_renderView();
    }
    
    
    public function editAction(){   
        $this->_lang->load('template.common');
        $this->_lang->load('employee.edit');
         $id = $this->FilterInt($this->_params[0]);
//         var_dump($id);
         $emp = EmployeeModel::getByPK($id);
         if($emp == null){
             $this->redirect('/employee/default');
         }
         $this->_data['employee'] = $emp;
//         var_dump($emp);
        if(isset($_POST['submit'])){
            $emp->name = $this->FilterSTR($_POST['name']);
            $emp->address = $this->FilterSTR($_POST['address']);
            $emp->type    = $this->FilterSTR($_POST['type']);
            $emp->age = $this->FilterInt($_POST['age']);
            $emp->salary = $this->FilterFLOAT($_POST['salary']);
            $emp->tax = $this->FilterFLOAT($_POST['tax']);
            
            if($emp->save()){
                $_SESSION['message'] = 'Employee Update Successfuly' ;
                $this->redirect('/employee/default');
            }
        }
        $this->_renderView();
    }
    
    
    public function deleteAction(){   
         $id = $this->FilterInt($this->_params[0]);
//         var_dump($id);
         $emp = EmployeeModel::getByPK($id);
         if($emp == null){
             $this->redirect('/employee/default');
         }
         $this->_data['employee'] = $emp;
//         var_dump($emp);
         if($emp->delete()){
                $_SESSION['message'] = 'Employees deleted Successfuly' ;
                $this->redirect('/employee/default');
            }
    }
}
