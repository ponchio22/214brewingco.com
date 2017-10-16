<?php

namespace Administration\Controls;

use Ima\UI\FormField;
use Ima\UI\FormFieldInterface;
use Ima\UI\Javascript;

/**
 * ShowAdvancedOptionsFormField
 * @author lpena
 */
class ShowAdvancedOptionsFormField extends FormField implements FormFieldInterface {
    
    private $collapseId;
    
    public function __construct($collapseId,$label="Opciones Avanzadas") {
        parent::__construct("advancedOptions", "advancedOptions", $label);
        $this->collapseId = $collapseId;
        $this->setHtmlFile("bundles/Administration/views/Ajax/ShowAdvancedOptionsFormField.php");
        $this->addJavascript(new Javascript("resources/Administration/js/ShowAdvancedOptionsFormField.js"));
    }
    
    public function getCollapseId() {
        return $this->collapseId;
    }

    public function setCollapseId($collapseId) {
        $this->collapseId = $collapseId;
        return $this;
    }


}
