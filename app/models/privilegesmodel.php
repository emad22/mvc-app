<?php
namespace PHPMVC\models;
class PrivilegesModel extends AbstractModel {
    //put your code here
    public $PrivilegeId;
    public $Privilege;
    public $PrivilegeTitle;
    
    
    protected static $tableName = "app_users_privileges";
    protected static $primaryKey = "PrivilegeId";
    
    protected static $tableSchema = array(
        'PrivilegeId'       =>self::DATA_TYPE_INT,
        'Privilege'         =>self::DATA_TYPE_STR,
        'PrivilegeTitle'    =>self::DATA_TYPE_STR
    );


    
}
