<?php

namespace Administration\Controls;

use Administration\Data\Template\FormButton;
use Ima\UI\Javascript;


/**
 * DeleteButton
 * @author lpena
 */
class DeleteButton extends FormButton {
    
    private $modalMessage = "¿Estas seguro que deseas eliminar el registro?";
    
    public function __construct($id, $name) {
        parent::__construct($id, $name, "<span class='glyphicon glyphicon-trash'></span> Eliminar");
        $this->addCssClass("form_delete_button");
        $this->htmlFile = "bundles/Administration/views/Ajax/DeleteButton.php";
        $this->addJavascript(new Javascript("resources/Administration/js/DeleteButton.js"));
    }
    /**
     * 
     * @return type
     */
    public function getModalMessage() {
        return $this->modalMessage;
    }
    /**
     * 
     * @param type $modalMessage
     * @return \Administration\Controls\DeleteButton
     */
    public function setModalMessage($modalMessage) {
        $this->modalMessage = $modalMessage;
        return $this;
    }


}
