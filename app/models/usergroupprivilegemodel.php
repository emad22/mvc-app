<?php
namespace PHPMVC\models;
class UserGroupPrivilegeModel extends AbstractModel {
    //put your code here
    public $groupId;
    public $groupName;
    
    
    protected static $tableName = "app_users_groups_privileges";
    protected static $primaryKey = "Id";
    
    protected static $tableSchema = array(
        'Id'            =>self::DATA_TYPE_INT,
        'GroupId'       =>self::DATA_TYPE_INT,
        'PrivilegeId'   =>self::DATA_TYPE_INT
    );


    
}
