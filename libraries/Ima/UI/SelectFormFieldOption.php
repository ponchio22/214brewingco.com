<?php

namespace Ima\UI;

/**
 * Represents an option of the select field 
 *
 * @author LuisAlfonso
 */
class SelectFormFieldOption {
    
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