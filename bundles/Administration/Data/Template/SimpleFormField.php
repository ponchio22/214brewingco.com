<?php

namespace Administration\Data\Template;

use Ima\UI\FormField;

/**
 * Represents a field of a simple form field
 *
 * @author LuisAlfonso
 */
class SimpleFormField extends FormField {    
    
    public function __construct($id, $name, $label, $type, $value = '', $placeholder = '') {
        parent::__construct($id, $name,$label, $type, $value, $placeholder);
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormInputTextField.php';
        $this->outputOnlyIput = false;
    }

}
