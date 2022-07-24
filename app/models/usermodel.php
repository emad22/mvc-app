<?php
namespace PHPMVC\models;
class UserModel extends AbstractModel {
    public $UserId;
    public $Username;
    public $Password;
    public $Email;
    public $PhoneNumber;
    public $SubscriptionDate;
    public $LastLogin;
    public $GroupId;
    public $Status;
    
    
    protected static $tableName = "app_users";
    protected static $primaryKey = "UserId";
    
    protected static $tableSchema = array(
        'UserId'            => self::DATA_TYPE_INT,
        'Username'          => self::DATA_TYPE_STR,
        'Password'          => self::DATA_TYPE_STR,
        'Email'             => self::DATA_TYPE_STR,
        'PhoneNumber'       => self::DATA_TYPE_STR,
        'SubscriptionDate'  => self::DATA_TYPE_DATE,
        'LastLogin'         => self::DATA_TYPE_DATE,
        'GroupId'           => self::DATA_TYPE_INT,
        'Status'            => self::DATA_TYPE_INT,
    );
    
    public function encypass($password){
        $this->Password =  sha1($password);
    }

//    public static function getUsers(UserModel $user)
//    {
//        return self::get(
//        'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId = au.GroupId WHERE au.UserId != ' . $user->UserId
//        );
//    }

    
    public static function getAll()
    {
        return self::get(
        'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId = au.GroupId  ' 
        );
    }
    
    
    
    public static function userExists($username)
    {
        return self::get('
            SELECT * FROM ' . self::$tableName . ' WHERE Username = "' . $username . '"
        ');
    }
  
//    public function setName($name){
//        $this->name = $name;
//    }

//    public function getTableName() {
//        return self::$tableName;
//    }

    
}
