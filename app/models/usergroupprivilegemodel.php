<?php
namespace PHPMVC\models;
class UserGroupPrivilegeModel extends AbstractModel {
    //put your code here
    public $Id;
    public $GroupId;
    public $PrivilegeId;
    
    
    protected static $tableName = "app_users_groups_privileges";
    protected static $primaryKey = "Id";
    
    protected static $tableSchema = array(

        'GroupId'       =>self::DATA_TYPE_INT,
        'PrivilegeId'   =>self::DATA_TYPE_INT
    );
    
    public static function getGroupPrivileges(UserGroupModel $group) {
        $groupPrivileges = self::getBy(['GroupId' => $group->GroupId]);
        $extractedPrivilegesIds = [];
        if(false !== $groupPrivileges) {
            foreach ($groupPrivileges as $privilege) {
                $extractedPrivilegesIds[] = $privilege->PrivilegeId;
            }
        }
        return $extractedPrivilegesIds;
    }

    public static function getPrivilegesForGroup($groupId)
    {
        $sql = 'SELECT augp.*, aup.Privilege FROM ' . self::$tableName . ' augp';
        $sql .= ' INNER JOIN app_users_privileges aup ON aup.PrivilegeId = augp.PrivilegeId';
        $sql .= ' WHERE augp.GroupId = ' . $groupId;
//        var_dump($sql);
        $privileges =  self::get($sql);
        $extractedUrls = [];
        if(false !== $privileges) {
            foreach ($privileges as $privilege) {
                $extractedUrls[] = $privilege->Privilege;
            }
        }
        return $extractedUrls;
    }


    
}
