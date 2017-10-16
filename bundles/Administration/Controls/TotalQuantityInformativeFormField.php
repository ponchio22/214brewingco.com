<?php

namespace Administration\Controls;

use Ima\UI\FormField;
use Ima\UI\Javascript;

/**
 * TotalQuantityInformativeFormField
 * @author lpena
 */
class TotalQuantityInformativeFormField extends FormField {
    
    private $total;
    
    public function __construct($id = "") {
        parent::__construct($id,"","");
        $this->setHtmlFile("bundles/Administration/views/Ajax/TotalQuantityInformativeFormField.php");
        $this->addJavascript(new Javascript("resources/Administration/js/TotalQuantityInformativeFormField.js"));
        $this->total = 0;
        $this->label = "Etiqueta";
    }    
    /**
     * Set the total quantity to show
     * @param type $total
     * @return \Administration\Controls\TotalQuantityInformativeFormField
     */
    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }
    /**
     * Get the total quantity to show
     * @return string
     */
    public function getTotal() {
        return $this->total;
    }

}
