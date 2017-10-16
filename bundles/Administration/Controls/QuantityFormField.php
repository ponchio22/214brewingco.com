<?php

namespace Administration\Controls;

use Ima\UI\FormField;
use Ima\UI\Javascript;

/**
 * QuantityFormField
 * @author lpena
 */
class QuantityFormField extends FormField {
    
    public function __construct($id, $name, $label) {
        parent::__construct($id, $name, $label);
        $this->htmlFile = "bundles/Administration/views/Ajax/QuantityFormField.php";
        $this->addJavascript(new Javascript("resources/Administration/js/QuantityFormField.js"));
        $this->setValue(0);
    }
}
