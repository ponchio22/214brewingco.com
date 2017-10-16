<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\MySql;

use Ima\MySql\MySqlObject;
use Symfony\Component\HttpFoundation\Session\Session;

class MySqlTable extends MySqlConnection {
    
    protected $tableName;
    private $columns = array();
    private $primaryKey = "id";
    private $lastResult;
    
    protected function __construct($tablename='') {
        $this->tableName = $tablename;        
        $this->connect();        
        $this->addColumn($this->primaryKey, "INT(12) UNSIGNED NOT NULL AUTO_INCREMENT");        
    }
    
    /**
     * Checks if the table exists
     * @return boolean
     */
    public function exists() {
        $query = "SHOW TABLES LIKE '$this->tableName'";
        $this->lastResult = $this->query($query);        
        return (mysql_num_rows($this->lastResult) > 0);         
    }
    
    /**
     * Returns the count of rows found for the given column and value, or the count
     * of all the rows in the table if blank
     * @param string $columnName
     * @param string $value
     * @return int Count of rows found
     */
    public function count($columnName='',$value='',$operator='=') {        
        if($columnName=='' && $value=='') {
            $query = "SELECT COUNT(*) FROM $this->tableName";
        } else {
            $query = "SELECT COUNT(*) FROM $this->tableName WHERE $columnName $operator '$value'";
        }        
        $this->lastResult = $this->query($query);
        if($this->lastResult) {
            $data = mysql_fetch_assoc($this->lastResult);
        } else {
            echo $query;
            die(mysql_error());
        }
        return $data['COUNT(*)'];
    }
    
    /**
     * Adds a column to the structure of the table (used when the create method is called)
     * @param string $columnName
     * @param string $columnDefinition
     */
    protected function addColumn($columnName,$columnDefinition) {
        $this->columns[] = new MySqlTableColumn($columnName, $columnDefinition);
    }
    
    /**
     * Creates a table in the mysql database
     */
    public function create() {
        $query = "CREATE TABLE $this->tableName (";
        $sep = ", ";
        foreach($this->columns as $column) {
            $query .= $column->columnName . " " . $column->columnDefinition . $sep;
        }
        $query .= "PRIMARY KEY($this->primaryKey))";
        $this->query($query);
    }    
    
    /**
     * Executes the given query
     * @param type $query
     * @return mysql query result
     */
    protected function query($query) {
        $sql = '...';
        $msc = -microtime(true);
        if(!$this->connected) { $this->connect();}        
        $this->lastResult = mysql_query($query);
        $msc += microtime(true);
        MySqlLog::addLog(array("log"=>$query,"time"=>$msc));
        return $this->lastResult;
    }
    
    /**
     * Gets the last inserted id
     * @return int The id of the inserted id or false if not available;
     */
    public function getLastInsertedId() {
        return mysql_insert_id();
    }
    
    public function preserveLastInsertedId() {
        $session = new Session();
        $session->set($this->tableName.'_last_inserted_id',  mysql_insert_id());
    }
    
    public function getAffectedRows() {
        return mysql_affected_rows($this->link);
    }
    
    /**
     * Gets the last preserved id
     * @return int Value of the last preserved id, NULL if no one found
     */
    public function getPreservedLastInsertedId($remove=false) {
        $session = new Session();        
        $id =$session->get($this->tableName.'_last_inserted_id');
        if($remove==true) {
            $session->remove($this->tableName.'_last_inserted_id');
        }
        return $id;
    }
    
    /**
     * Creates the table if it doesnt exist
     */
    protected function createIfDoesntExists(MySqlObject $object=NULL) {
        if($object!=NULL) {
            $this->columns = array();
            /* @var $field MysqlObjectField */
            foreach($object->getFields() as $field) {
                $this->addColumn($field->getName(), $field->getType());                
            }
        }
        if(!$this->exists()) {
            $this->create();            
        }
    }
    
    /**
     * Creates a mysql query to insert the given object as a parameter
     * @param MySqlObject $object
     * @return string String with the query
     */
    public function createInsertQuery(MySqlObject $object) {
        if(is_object($object)) {
            $vars = get_object_vars($object);
            $keys = implode(',',array_keys($vars));
            $values = implode(',',array_map(create_function('$a', 'return "\'".mysql_real_escape_string($a)."\'";'), array_values($vars)));
            $query = "INSERT INTO $this->tableName ($keys) VALUES ($values)";
            return $query;
        } else {
            return '';
        }
    }
    
    /**
     * Creates a mysql query to update the given object as a parameter
     * @param MySqlObject $object
     * @param string $searchColumn Column used as a unique key id of the table
     * @return string String with the query
     */
    public function createUpdateQuery(MySqlObject $object,$searchColumn='id') {
        if(is_object($object)) {
            $searchColumnExists = property_exists($object, $searchColumn);
            if($searchColumnExists) {
                $vars = get_object_vars($object);
                $value = $vars[$searchColumn];
                unset($vars[$searchColumn]);
                array_walk($vars, function(&$value,$key){$value = "$key='$value'";});
                $keysValues = \implode(', ',$vars);
                $query = "UPDATE $this->tableName SET $keysValues WHERE $searchColumn='$value'";
                return $query;
            }
        } 
        return '';
    }
    
    /**
     * Generates a delete query with a given object
     * @param Object $object Object 
     * @return string
     */
    public function createDeleteQuery($object) {
        if(is_object($object)) {
            $query = "DELETE FROM $this->tableName WHERE id='$object->id'";
            return $query;
        } else {
            return '';
        }
    }
    
    /**
     * Generates a select query with an option for search value and search column input     
     * @param string $searchValue Value to search
     * @param type $searchColumn Column to search for the given value, the default is the id column
     * @return string Query ready for mysql usage
     */
    public function createSelectQuery($searchValue='',$searchColumn='id') {
        $query = "SELECT * FROM $this->tableName WHERE $searchColumn='$searchValue'"; 
        return $query;
    }
    
    /**
     * Generates a select query for all the registries in the table
     * @return string
     */
    public function createSelectAllQuery() {
        $query = "SELECT * FROM $this->tableName";
        return $query;
    }
    
    /**
     * Fetch a single object from the result of the query
     * @param string $result mysql query result
     * @param Object $object Object to populate
     * @return Object
     */
    public function fetchObject($result,$object) {        
        $data = mysql_fetch_assoc($result);        
        if(!$data) {
            $object = NULL;
        } else {
            $object = $this->associateObject($object, $data);
        }
        return $object;
    }
    
    /**
     * Creates an array of objects with the given mysql select result
     * @param type $result mysql query result
     * @param type $object Object to populate
     * @return type
     */
    public function fetchObjectArray($result,$object) {
        $array = array();
        if($result) {
            $class = get_class($object);
            while($item = mysql_fetch_array($result)) {            
                $array[] = $this->associateObject(new $class(), $item);
            }
        }
        return $array;
    }
    
    /**
     * Associates an object with the given array data
     * @param Object $object Object to populate
     * @param array $arrayData Array source data
     * @return MySqlObject
     */
    public function associateObject($object,array $arrayData) {
        $vars = get_object_vars($object);        
        foreach($vars as $key=>$value) {
            if(array_key_exists($key, $arrayData)) {
                $object->$key = $arrayData[$key];
            }
        }
        //Getters, Setters
        $functions = get_class_methods($object);        
        foreach($functions as $key=>$function) {
            $variableName = lcfirst(str_replace("get","",$function));
            if(array_key_exists($variableName,$arrayData)) {
                $setter = "set".ucfirst($variableName);                
                if(method_exists($object,$setter)) {                    
                    $object->$setter($arrayData[$variableName]);
                }
            }
        }
        return $object;
    }
    
    /**
     * Adds a new object to the system
     * @param MysqlObject $object
     * @return boolean True if success
     */
    public function add(MySqlObject $object) {
        $query = $this->createInsertQuery($object);
        $this->lastResult = $this->query($query);
        if($this->lastResult) $this->preserveLastInsertedId();
        return $this->lastResult;
    }
    
    /**
     * Deletes the given expense
     * @param MysqlObject $object Object to delete
     * @return boolean True if success
     */
    public function delete(MySqlObject $object) {
        $query = $this->createDeleteQuery($object);
        $this->lastResult = $this->query($query);
        return $this->lastResult;
    }
    
    /**
     * Updates the given object
     * @param MysqlObject $object
     * @return boolean
     */
    public function update(MySqlObject $object) {        
        $query = $this->createUpdateQuery($object);              
        $this->lastResult = $this->query($query);        
        return $this->lastResult;
    }
    
    /**
     * Gets the object based on the given id
     * @param type $id Id of the object to get
     * @param MysqlObject $object Object to store the data (usually new MysqlObject())
     * @return MysqlObject
     */
    public function get($id,  MySqlObject $object) {
        $query = $this->createSelectQuery($id);        
        $this->lastResult = $this->query($query);        
        $returnobject = $this->fetchObject($this->lastResult, $object);
        return $returnobject;
    }
    
    /**
     * Gets all the objects from the database
     * @param MysqlObject $object Object type that will be used (use as New MysqlObject())
     * @return array Array of objects
     */
    public function all(MySqlObject $object) {
        $query = $this->createSelectAllQuery();
        $this->lastResult = $this->query($query);
        $items = $this->fetchObjectArray($this->lastResult, $object);
        return $items;
    }
    
    public function getTableName() {
        return $this->tableName;
    }


}