<?php
namespace PHPMVC\models;
class UserModel extends AbstractModel {
    //put your code here
    public $userId;
    public $userName;
    public $password;
    public $email;
    public $phoneNumber;
    public $subscribtion;
    public $lastLogin;
    public $groupId;
    
    
    protected static $tableName = "app_users";
    protected static $primaryKey = "userId";
    
    protected static $tableSchema = array(
        'userId'             =>self::DATA_TYPE_INT,
        'userName'           =>self::DATA_TYPE_STR,
        'password'           =>self::DATA_TYPE_STR,
        'email'              =>self::DATA_TYPE_STR,
        'phoneNumber'        =>self::DATA_TYPE_INT,
        'subscribtion'       =>self::DATA_TYPE_STR,
        'lastLogin'          =>self::DATA_TYPE_STR,
        'groupId'            =>self::DATA_TYPE_INT
    );



  
//    public function setName($name){
//        $this->name = $name;
//    }

//    public function getTableName() {
//        return self::$tableName;
//    }

    
}
