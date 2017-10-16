<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\Data;

/**
 * Description of Object
 *
 * @author lpena
 */
class Object {
    
    protected $id = '';
    
    /**
     * Returns a MySqlObject and if given fills the variables with the array data
     * @param array $data Data to fill into the variables
     */
    public function __construct(array $data = array()) {
        $this->associateArray($data);
    }
    
    /**
     * Associates the array data to the variables of the object
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
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
}
