<?php
namespace PHPMVC\models;
use PHPMVC\Lib\Database\DatabaseHandler;
class AbstractModel {
   // protected static $tableName;
    
//    DATA Type Which i used
   CONST DATA_TYPE_BOL     = \PDO::PARAM_BOOL;
   CONST DATA_TYPE_STR     = \PDO::PARAM_STR;
   CONST DATA_TYPE_INT     = \PDO::PARAM_INT;
   CONST DATA_TYPE_DATE    = 5;
   CONST DATA_TYPE_DECIMAL = 4;
   
   
//   prepare sql statment
    protected function PrepareValues(\PDOStatement &$stmt){
//        var_dump($stmt);
       foreach (static::$tableSchema AS $columnName=>$type){
            if($type == 4){
                $santizedPararm = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $santizedPararm);
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName,$type);
            }
        }
   }
   
//   bind param 
//   name = :name and so on
    public static function  BulidNamePasamSQL(){
       $namedParam = '';
       foreach (static::$tableSchema AS $columnName=>$type){
            $namedParam .= $columnName.'= ' .' :'.$columnName .',' ;
              }
        return trim($namedParam , ',');
    }
    
//    Create SQL Statmend
    private function create() {
        global $pdo;
        $sql = 'INSERT INTO ' .STATIC::$tableName . ' SET ' . self::BulidNamePasamSQL() ;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->PrepareValues($stmt);
        if($stmt->execute()){
            $this->{STATIC::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;

    }
    
//    update sql Statment
    private function update() {
        global $pdo;
        $sql = 'UPDATE ' .STATIC::$tableName . ' SET ' . self::BulidNamePasamSQL() .' WHERE ' .STATIC::$primaryKey.' = '.$this->{STATIC::$primaryKey} ;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->PrepareValues($stmt);
        return $stmt->execute();        
    }
    
/*
 * save fuction check if is on primary key call to update else call create function
 */
    
    public function save(){
        return $this->{STATIC::$primaryKey}=== null ? $this->create() : $this->update();
    }
    
    /*
     * delete SQL Statment
     */
    public function delete() {
        global $pdo;
        $sql = 'DELETE FROM ' .STATIC::$tableName . ' WHERE ' .STATIC::$primaryKey.'='.$this->{STATIC::$primaryKey} ;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        return $stmt->execute();        
    }
    
    
    /*
     * get All Data Fromm  tables
     */
    public static function getAll(){
        $sql = 'SELECT * FROM ' . static::$tableName ;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
//        $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class() , array_keys(static::$tableSchema) );
//        return  (is_array($results)) && !empty($results)  ?  $results : False ;
        // Check the construct is i or not
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
//            return new \ArrayIterator($results);
            return  (is_array($results)) && !empty($results)  ?  $results : False ;
        };
        return false;
    }
    
    
    /*
     * get specifc data By id
     */
    public static function getByPK( $pk ){
        global $pdo;
        $sql = 'SELECT * FROM ' . static::$tableName .' WHERE ' .STATIC::$primaryKey.'='.$pk;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if ($stmt->execute() == true){
            if(method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class() , array_keys(static::$tableSchema) );
            }
            $obj = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class());
            $obj = array_shift($obj);
            return $obj;
        } else {
            return false;
        }
    }
    // For specific sql Query
    public static function get($sql ,$options = array() ){
         global $pdo;
         $stmt = DatabaseHandler::factory()->prepare($sql);
         if(!empty($options)){
                foreach ($options AS $columnName=> $type){
               if($type[0] == 4){
                   $santizedPararm = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                   $stmt->bindValue(":{$columnName}", $santizedPararm);
               } else {
                   $stmt->bindValue(":{$columnName}", $type[1],$type[0]);
               }
           }
           $stmt->execute();
           $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class() , array_keys(static::$tableSchema) );
           
//           if(is_array($results) && !empty($results)){
//               
//           }
           return  (is_array($results)) && !empty($results)  ?  $results : False ;
         }
    }
}



   
