<?php

namespace Administration\Controls;

use Administration\Data\Template\FormButton;
use Ima\UI\Javascript;

/**
 * SpinnerButton
 * @author lpena
 */
class SpinnerButton extends FormButton {
    
    public function __construct($id, $name, $label, $visible = true, $primary = false) {
        parent::__construct($id, $name, $visible, $primary);
        $this->addJavascript(new Javascript("resources/Administration/js/SpinnerButton.js"));
        $this->label = "<span class='btnSpinner fa fa-spinner fa-spin' style='display:none;'></span> " . $label;        
        $this->addCssClass("spinnerButton");
    }
}
