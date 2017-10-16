<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Administration\Controls;

use Ima\UI\FormField;
use Ima\UI\Javascript;

/**
 * Description of AutocompleteFormField
 *
 * @author LuisAlfonso
 */
class AutocompleteFormField extends FormField {
    
    private $ajaxPath;
    
    private $optionExistsIndicator = true;
    
    private $notFoundMessage = "No se encontró el valor ingresado";
    
    private $showClearAddOn = false;
    
    private $compactMode = false;
    
    public function __construct($id, $name, $label,$ajaxPath) {
        parent::__construct($id, $name, $label);
        $this->setHtmlFile("bundles/Administration/views/Ajax/AutocompleteFormField.php");
        $this->addJavascript(new Javascript("resources/Administration/js/AutocompleteFormField.js"));
        $this->addJavascript(new Javascript("resources/bootstrap-ajax-typeahead-master/js/bootstrap-typeahead.js"));
        $this->ajaxPath = $ajaxPath;
    }
    /**
     * 
     * @return type
     */
    public function getAjaxPath() {
        return $this->ajaxPath;
    }
    /**
     * 
     * @param type $ajaxPath
     * @return \Administration\Controls\AutocompleteFormField
     */
    public function setAjaxPath($ajaxPath) {
        $this->ajaxPath = $ajaxPath;
        return $this;
    }
    
    public function getOptionExistsIndicator() {
        return $this->optionExistsIndicator;
    }

    public function setOptionExistsIndicator($optionExistsIndicator) {
        $this->optionExistsIndicator = $optionExistsIndicator;
        return $this;
    }

    public function getNotFoundMessage() {
        return $this->notFoundMessage;
    }

    public function setNotFoundMessage($notFoundMessage) {
        $this->notFoundMessage = $notFoundMessage;
        return $this;
    }
    
    public function getCompactMode() {
        return $this->compactMode;
    }

    public function setCompactMode($compactMode) {
        $this->compactMode = $compactMode;
        return $this;
    }
    
    public function getShowClearAddOn() {
        return $this->showClearAddOn;
    }

    public function setShowClearAddOn($showClearAddOn) {
        $this->showClearAddOn = $showClearAddOn;
        return $this;
    }




}
