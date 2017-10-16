<?php

namespace Administration\Controls;

use Administration\Data\Template\FormButton;
use Ima\Routing\Routing;
use Ima\UI\Javascript;

/**
 * RegresarButton
 * @author lpena
 */
class RegresarButton extends FormButton {
    
    public function __construct($id, $name, $visible = true, $primary = false) {
        parent::__construct($id, $name, $visible, $primary);
        $this->addJavascript(new Javascript("resources/Administration/js/RegresarButton.js"));
        $this->label = "<span class='regresarArrow glyphicon glyphicon-chevron-left'></span><span class='regresarSpinner fa fa-spinner fa-spin' style='display:none;'></span> Regresar";
        $this->setVisible(Routing::hasPreviousUrl());
        $this->addAttribute(["previous-url"=>Routing::getPreviousUrl()]);
        $this->addCssClass("regresarButton");
    }
}
