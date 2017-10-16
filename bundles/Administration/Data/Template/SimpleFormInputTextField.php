<?php

namespace Administration\Data\Template;

use Ima\UI\FormField;

/**
 * Campo de texto sencillo
 *
 * @author lpena
 */
class SimpleFormInputTextField extends FormField {
    
    public function __construct($id, $name, $label, $value = '', $placeholder = '') {
        parent::__construct($id, $name, $label, SimpleFormField::INPUT_TEXT, $value, $placeholder);   
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormInputTextField.php';
    }
}
