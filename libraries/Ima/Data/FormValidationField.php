<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\Data;

/**
 * Description of ValidationField
 *
 * @author lpena
 */
class FormValidationField {
    
    private $validationName;
    
    private $parameters;
    
    public function __construct($validationName,array $parameters) {
        $this->validationName = $validationName;
        $this->parameters = $parameters;
    }
    
    public function getValidationMethod() {
        return 'validate'.$this->validationName;
    }
    
    public function getParameters() {
        return $this->parameters;
    }
}
