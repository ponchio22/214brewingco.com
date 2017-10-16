<?php

namespace Administration\Controls;

use Administration\Data\Template\SimpleFormInputTextField;

/**
 * EmailFormField
 * @author LuisAlfonso
 */
class EmailFormField extends SimpleFormInputTextField {
    
    public function __construct($id, $name, $label, $value = '', $placeholder = '') {
        parent::__construct($id, $name, $label, $value, "eg. ejemplo@empresa.com");
    }
}
