<?php

namespace Administration\Data\Template;

/**
 * Represents an option of the simple form select field 
 *
 * @author LuisAlfonso
 */
class SimpleFormSelectFieldOption {
    
    private $value;
    
    private $text;
    
    public function __construct($value,$text) {
        $this->value = $value;
        $this->text = $text;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function getText() {
        return $this->text;
    }
}
