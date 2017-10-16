<?php
namespace Ima\Data;

use Ima\Data\FormValidationField;

/**
 * Description of Validation
 *
 * @author lpena
 */
class Validation {
    
    protected $succeeded = true;
    
    /**
     * Validates the field value string or array is not empty
     * @param type $value
     * @return type
     */
    public function Populated($value) {
        if(is_array($value)) {
            $return = (count($value)>0);
            $this->succeeded = ($return == true)? $this->succeeded:false;
            return $return;
        } else {
            $return = ($value!='' && $value!=NULL);
            $this->succeeded = ($return==true)? $this->succeeded:false;
            return $return;
        }
    }
    
    public function Length($value,$min,$max) {
        $return = $this->CountOfItems(strlen($value), $min, $max);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function MaxLength($value,$max) {
        $return = $this->CountOfItems(strlen($value), -1, $max);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function MinLength($value,$min) {        
        $return = $this->CountOfItems(strlen($value), $min, -1);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function ExactLength($value,$length) {
        $return = $this->CountOfItems(strlen($value), $length, $length);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function MinWords($value,$min) {
        $return = $this->CountOfItems(str_word_count($value), $min, -1);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function MaxWords($value,$max) {
        $return = $this->CountOfItems(str_word_count($value), -1, $max);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function Words($value,$min,$max) {
        $return = $this->CountOfItems(str_word_count($value), $min, $max);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function ExactWords($value,$length) {
        $return = $this->CountOfItems(str_word_count($value), $length, $length);
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function Email($value) {
        $return = (filter_var($value, FILTER_VALIDATE_EMAIL));
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function Money($value) {
        $return = (preg_match('/^[0-9]{1,}$|^[0-9]{1,}\.[0-9]{1,2}$/', $value));
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function Numeric($value) {
        $return = (preg_match('/^[0-9]{1,}$/', $value));
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function NumericExact($value,$min,$max) {
        $return = false;
        if($this->Numeric($value)) {
            $return = $this->CountOfItems($value, $min, $max);
        }
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    private function CountOfItems($count,$min,$max) {
        if($min == $max && $min>0) {
            $return = ($count==$min);
        } else if($max==-1) {
            $return = ($count>=$min);
        } else if($min==-1) {
            $return = ($count<=$max);
        } else if ($min!=$max) {
            $return = ($count >= $min && $count <= $max);
        }
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
    
    public function getSucceeded() {
        return $this->succeeded;
    }
    
    public function setSucceeded($succeeded) {
        $this->succeeded = $succeeded;
    }
    
    public function NumericMatches($value,$searchValue,$falseIfMatches=true) {        
        $return = (floatval($value) == floatval($searchValue));
        $return = ($falseIfMatches)? !$return:$return;
        $this->succeeded = ($return==true)? $this->succeeded:false;
        return $return;
    }
}
