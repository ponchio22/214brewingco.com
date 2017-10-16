<?php

namespace Ima\UI;

use Ima\UI\FormField;

/**
 * SelectFormField
 *
 * @author LuisAlfonso
 */
class SelectFormField extends FormField {
    
    private $options;
    
    public function __construct($id, $name, $label, $type = '', $value = '', $placeholder = '', $visible = true) {
        parent::__construct($id, $name, $label, $type, $value, $placeholder, $visible);        
        $options = array();
    }
    
    public function setOptions(array $options) {
        $this->options = $options;
        return $this;
    }
    
    public function addOption(SelectFormFieldOption $option) {
        $this->options[] = $option;
        return $this;
    }
    
    public function getOptions() {
        return $this->options;
    }
    
    public function getAddButtonName() {
        return $this->getId() . "_agregar";
    }
    
    public function isAddButtonClicked() {        
        return (Request::createFromGlobals()->request->get($this->getAddButtonName())!=NULL);
    }
    
    public function valueMatches($value) {
        if(is_array($this->getValue())) {            
            foreach($this->getValue() as $v) {                
                if($v==$value) {                    
                    return true;
                }
            }
            return false;
        } else {
            return ($this->getValue() == $value);
        }
    }
}
