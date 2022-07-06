<?php
namespace PHPMVC\models;
class EmployeeModel extends AbstractModel {
    //put your code here
    public $id;
    public $name;
    public $address;
    public $type;
    public $age;
    public $salary;
    public $tax;
    
    
    protected static $tableName = "emp";
    protected static $primaryKey = "id";
    
    protected static $tableSchema = array(
        'name'       =>self::DATA_TYPE_STR,
        'address'    =>self::DATA_TYPE_STR,
        'type'       =>self::DATA_TYPE_STR,
        'age'        =>self::DATA_TYPE_INT,
        'salary'     =>self::DATA_TYPE_DECIMAL,
        'tax'        =>self::DATA_TYPE_DECIMAL
    );


//    public function __construct($name,$address,$age,$salary,$tax ) {
//        global $pdo;
//        $this->name = $name;
//        $this->address = $address;
//        $this->age  = $age;
//        $this->salary = $salary;
//        $this->tax  = $tax;
//        
//    }
    
    
    
    public function setName($name){
        $this->name = $name;
    }

    
    public function getTableName() {
        return self::$tableName;
    }
    
  
    
}
