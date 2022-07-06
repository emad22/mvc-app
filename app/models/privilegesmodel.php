<?php
namespace PHPMVC\models;
class PrivilegesModel extends AbstractModel {
    //put your code here
    public $privilegeId;
    public $privilege;
    public $privilegeTitle;
    
    
    protected static $tableName = "app_users_privileges";
    protected static $primaryKey = "privilegeId";
    
    protected static $tableSchema = array(
        'privilegeId'       =>self::DATA_TYPE_INT,
        'privilege'         =>self::DATA_TYPE_STR,
        'privilegeTitle'         =>self::DATA_TYPE_STR
    );


    
}
