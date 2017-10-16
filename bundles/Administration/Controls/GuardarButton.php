<?php

namespace Administration\Controls;

/**
 * Description of GuardarButton
 *
 * @author LuisAlfonso
 */
class GuardarButton extends \Administration\Controls\SpinnerButton {
    
    public function __construct($id, $name) {
        parent::__construct($id, $name, "<span class='glyphicon glyphicon-floppy-disk'></span> Guardar");
    }
}
