<?php
namespace PHPMVC\models;
use PHPMVC\Lib\Database\DatabaseHandler;
class AbstractModel {
   // protected static $tableName;
    
//    DATA Type Which i used
   CONST DATA_TYPE_BOL     = \PDO::PARAM_BOOL;
   CONST DATA_TYPE_STR     = \PDO::PARAM_STR;
   CONST DATA_TYPE_INT     = \PDO::PARAM_INT;
   const DATA_TYPE_DATE = 5;
   CONST DATA_TYPE_DECIMAL = 4;
   
   const VALIDATE_DATE_NUMERIC = '^\d{6,8}$';
    const DEFAULT_MYSQL_DATE = '1970-01-01';
   
   
//   prepare sql statment
    protected function PrepareValues(\PDOStatement &$stmt){
        
       foreach (static::$tableSchema AS $columnName=>$type){
            if($type == 4){
                $santizedPararm = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $santizedPararm);
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName,$type);
            }
        }
        
   }
   
   
//   private function PrepareValues(\PDOStatement &$stmt)
//    {
//        foreach (static::$tableSchema as $columnName => $type) {
//            if ($type == 4) {
//                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//                $stmt->bindValue(":{$columnName}", $sanitizedValue);
//            } else {
//                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
//            }
//        }
//    }
   
//   bind param 
//   name = :name and so on
    public static function  BulidNamePasamSQL(){
       $namedParam = '';
       foreach (static::$tableSchema AS $columnName=>$type){
            $namedParam .= $columnName.'= :' .$columnName .',' ;
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
//            
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
    public function save($primaryKeyCheck = true)
    {
        if(false === $primaryKeyCheck) {
            return $this->create();
        }
        return $this->{static::$primaryKey} === null ? $this->create() : $this->update();
    }
    
    
//    public function save(){
//        return $this->{STATIC::$primaryKey}=== null ? $this->create() : $this->update();
//    }
    
    /*
     * delete SQL Statment
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$tableName . '  WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
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
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
//            return  (is_array($results)) && !empty($results)  ?  $results : False ;
        };
        return false;
    }
    
    
    ///////////////////////////////////////////////////////////////////
    
    public static function getBy($columns, $options = array())
    {
        $whereClauseColumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = [];
        for ( $i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++ ) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }
        $whereClause = implode(' AND ', $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;
        return static::get($sql, $options);
    }
    
    //////////////////////////////////////////////////////////////////
    
    /*
     * get specifc data By id
     */
    public static function getByPK($pk)
    {
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . static::$primaryKey . ' = "' . $pk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if ($stmt->execute() === true) {
            if(method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        }
        return false;
    }
    // For specific sql Query
//    public static function get($sql ,$options = array() ){
//         global $pdo;
//         $stmt = DatabaseHandler::factory()->prepare($sql);
//         if(!empty($options)){
//                foreach ($options AS $columnName=> $type){
//               if($type[0] == 4){
//                   $santizedPararm = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
//                   $stmt->bindValue(":{$columnName}", $santizedPararm);
//               } else {
//                   $stmt->bindValue(":{$columnName}", $type[1],$type[0]);
//               }
//           }
////           var_dump($stmt);
//           $stmt->execute();
//           $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class() , array_keys(static::$tableSchema) );
//           
////           if(is_array($results) && !empty($results)){
////               
////           }
//           return  (is_array($results)) && !empty($results)  ?  $results : False ;
//         }
//    }
    
    
    public static function get($sql, $options = array())    {
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if (!empty($options)) {
            foreach ($options as $columnName => $type) {
                if ($type[0] == 4) {
                    $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}", $sanitizedValue);
                } elseif ($type[0] == 5) {
                    if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                        $stmt->bindValue(":{$columnName}", self::DEFAULT_MYSQL_DATE);
                        continue;
                    }
                    $stmt->bindValue(":{$columnName}", $type[1]);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                }
            }
        }
        $stmt->execute();
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }
    
    
    public static function getOne($sql, $options = array()){
        $result = static::get($sql, $options);
        return $result === false ? false : $result->current();
    }
}



   
