<?php
namespace PHPMVC\models;
class UserGroupModel extends AbstractModel {
    //put your code here
    public $groupId;
    public $groupName;
    
    
    protected static $tableName = "app_users_groups";
    protected static $primaryKey = "groupId";
    
    protected static $tableSchema = array(
        'groupId'       =>self::DATA_TYPE_INT,
        'groupName'       =>self::DATA_TYPE_STR
    );


    
}
