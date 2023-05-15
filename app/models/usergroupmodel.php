<?php
namespace PHPMVC\models;
class UserGroupModel extends AbstractModel {
    //put your code here
    public $groupId;
    public $groupName;
    
    
    protected static $tableName = "app_users_groups";
    protected static $primaryKey = "GroupId";
    
    protected static $tableSchema = array(
        'GroupName'       =>self::DATA_TYPE_STR
    );


    
}
