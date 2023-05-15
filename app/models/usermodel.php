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
        'SubscriptionDate'  => self::DATA_TYPE_STR,
        'LastLogin'         => self::DATA_TYPE_STR,
        'GroupId'           => self::DATA_TYPE_INT,
        'Status'            => self::DATA_TYPE_INT,
    );
    
    public function encypass($password){
        $this->Password =  sha1($password);
    }


    
    public static function getUsers(UserModel $user){
        return self::get(
        'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId = au.GroupId WHERE au.UserId != ' . $user->UserId
        );
    }
    public static function userExists($username) {
        return self::get('
            SELECT * FROM ' . self::$tableName . ' WHERE Username = "' . $username . '"
        ');
    }
    public static function EmailExists($email){
        return self::get('
            SELECT * FROM ' . self::$tableName . ' WHERE Email = "' . $email . '"
        ');
    }
    
    public static function authenticate ($username, $password, $session){
        $password = sha1($password);
//        $sql = 'SELECT * FROM ' .self::$tableName .' WHERE Username ="' .$username .'" AND Password= "' . $password .'"';
        $sql = 'SELECT *, (SELECT GroupName FROM app_users_groups WHERE app_users_groups.GroupId = ' . self::$tableName . '.GroupId) GroupName FROM ' . self::$tableName . ' WHERE Username = "' . $username . '" AND Password = "' .  $password . '"';
        $foundUser = self::getOne($sql);
        if(false !== $foundUser) {
            if($foundUser->Status == 2) {
                return 2;
            }
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByPK($foundUser->UserId);
            $foundUser->Privilege = UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId);
            $session->u = $foundUser;
            return 1;
        }
        return false;
        
    }
    
}
