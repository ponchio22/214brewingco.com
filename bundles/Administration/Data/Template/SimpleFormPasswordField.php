<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Administration\Data\Template;
use Ima\UI\FormField;

/**
 * Description of SimpleFormPasswordField
 *
 * @author lpena
 */
class SimpleFormPasswordField extends FormField {
    
    public function __construct($id, $name, $label, $value = '', $placeholder = '', $visible = true) {
        parent::__construct($id, $name, $label, FormField::PASSWORD, $value, $placeholder, $visible);
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormPasswordField.php';
    }
}
