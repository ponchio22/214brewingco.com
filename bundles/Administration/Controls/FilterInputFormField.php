<?php

namespace Administration\Controls;

use Ima\UI\Javascript;

/**
 * FilterInputFormField
 * @author lpena
 */
class FilterInputFormField extends \Administration\Controls\AutocompleteFormField {
    
    private $autoSubmit;
   
    
    public function __construct($id, $name, $label, $ajaxPath) {
        parent::__construct($id, $name, $label, $ajaxPath);
        $this->placeholder = $label;
        $this->setHtmlFile("bundles/Administration/views/Ajax/FilterInputFormField.php");        
        $this->addJavascript(new Javascript("resources/Administration/js/FilterInputFormField.js"));
        $this->setAutoSubmit(true);
    }
    
    public function getAutoSubmit() {
        return $this->autoSubmit;
    }

    public function setAutoSubmit($autoSubmit) {
        $this->autoSubmit = $autoSubmit;
        return $this;
    }
    
}
