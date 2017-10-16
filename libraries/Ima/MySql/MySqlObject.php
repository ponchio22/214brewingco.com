<?php

namespace Ima\MySql;

/**
 * Represents a mysql table structure, all the table structures used should extend this object
 */
class MySqlObject {
    
    public $id = '';
    
    /**
     * Returns a MySqlObject and if given fills the variables with the array data
     * @param array $data Data to fill into the variables
     */
    public function __construct(array $data = array()) {
        $this->associateArray($data);        
    }
    
    /**
     * Use Ima\Data\Object instead of MysqlObject
     * @deprecated
     * @param array $data
     * @return MySqlObject
     */
    public function associateArray(array $data) {
        if(count($data)>0) {
            $vars = get_object_vars($this);
            foreach($vars as $key=>$value) {
                if(array_key_exists($key, $data)) {
                    $this->$key = $data[$key];
                }
            }
        }
        return $this;
    }
}