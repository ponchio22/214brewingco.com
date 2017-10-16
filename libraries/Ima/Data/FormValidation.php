<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\Data;

use Ima\Data\Validation;
use Ima\Data\FormValidationField;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of FormValidation
 *
 * @author lpena
 */
class FormValidation extends Validation {
    
    protected $errors = array();
    
    protected $validationFields = array();
    
    protected $request;
    
    protected $formName;
    
    private $form;
    
    private $files;
    
    public function __construct(Request $request,$formName) {
        $this->request = $request;
        $this->formName = $formName;
        $this->form = $this->request->request->get($this->formName);
        $this->files = $this->request->files->get($this->formName);
    }
     /**
     * Adds a validation field to the list to be validated by the Validate function.
     * The validation for the field should be a method called validate[fieldName]
     * @param FormValidationField $field
     */
    public function AddValidationField($validationName,$parameters='') {
        if(is_array($parameters)) {
            foreach($parameters as $key=>$parameter) {
                $parameters[$key] = $parameter;
            }
        } else {
            $parameterValue = $parameters;
            if($parameterValue=='') {
                $parameters = array(strtolower($validationName));
            } else {
                $parameters = array(strtolower($parameterValue));
            }
        }
        $field = new FormValidationField($validationName,$parameters);
        $this->validationFields[] = $field;
    }
    
    /**
     * Adds an error to the list of errors
     * @param type $errorString
     * @return boolen Return False
     */
    public function AddError($errorString) {
        $this->errors[] = utf8_decode($errorString);
        return false;
    }
    
    /**
     * Get and array with all the errors from the form
     * @return array
     */
    public function GetErrors() {
        return $this->errors;
    }
    
    /**
     * Executes the validation of the form
     * @return boolean
     */
    public function Validate() {
        $valid = true;
        if(count($this->validationFields)>0) {
            foreach($this->validationFields as $key=>$validationField) {
                $parameters = $validationField->getParameters();
                $valueParameters = array();
                if(count($parameters)>0) {
                    foreach($parameters as $fieldName) {
                        if(array_key_exists($fieldName, $this->form)){
                            $valueParameters[] = $this->form[$fieldName];
                        }
                        if(is_array($this->files) && array_key_exists($fieldName, $this->files)){
                            $valueParameters[] = $this->files[$fieldName];
                        }
                    }
                }
                $valid = (call_user_func_array(array($this,$validationField->getValidationMethod()),$valueParameters))? $valid:false;
            }
        }
        return $valid;
    }
    
    public function GetFormData() {        
        if(is_array($this->files)) {
            $return = array_merge($this->form,$this->files);
        } else {
            $return = $this->form;
        }
        if($return == NULL) {
            $return = array();
        }
        return $return;
    }
}
