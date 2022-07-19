<?php
namespace PHPMVC\models;
class UserGroupModel extends AbstractModel {
    //put your code here
    public $groupId;
    public $groupName;
    
    
    protected static $tableName = "app_users_groups";
    protected static $primaryKey = "GroupId";
    
    protected static $tableSchema = array(
        'GroupId'         =>self::DATA_TYPE_INT,
        'GroupName'       =>self::DATA_TYPE_STR
    );


    
}
