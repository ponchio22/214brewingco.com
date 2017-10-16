<?php

namespace Administration\Data\Template;

use Administration\Data\Template\SimpleFormField;
use Ima\UI\Form;
use Ima\UI\FormField;
use Ima\UI\Javascript;
use Symfony\Component\HttpFoundation\Request;

/**
 * Represents a simpleform select field
 *
 * @author LuisAlfonso
 */
class SimpleFormSelectField extends SimpleFormField {
    
    private $options = array();
    
    private $addButton;
    
    private $submitOnChange = false;
    
    public function __construct($id,$name, $label, $value='',$options=array(),$multiple=false) {
        parent::__construct($id,$name, $label, ($multiple)? FormField::MULTIPLE_SELECT:FormField::SELECT, $value);        
        if(!$multiple) {
            $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormSelectField.php';
        } else {
            $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormMultipleSelectField.php';
        }
        $this->addJavascript(new Javascript("resources/Administration/js/SimpleFormSelectField.js"));
        $this->options = $options;
        $this->addButton = new \Administration\Data\Template\FormButton($id . "_agregar", $id . "_agregar", 'Agregar');
        $this->addItem($this->addButton);
    }
    /**
     * Override set form method
     * @param Form $form
     */
    public function setForm(Form $form) {
        parent::setForm($form);
        $this->addButton->setForm($form);
        return $this;
    }
    
    public function addOption(\Administration\Data\Template\SimpleFormSelectFieldOption $option) {
        $this->options[] = $option;
        return $this;
    }
    
    public function removeOption($index) {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
        return $this;
    }
    /**
     * Gets the option that belongs to the id
     * @param type $index
     * @return \Administration\Data\Template\SimpleFormSelectFieldOption
     */
    public function getOption($index) {
        return $this->options[$index];
    }
    
    public function clearOptions() {
        $this->options = array();
        return $this;
    }
    
    public function getOptions() {
        return $this->options;
    }
    
    public function getAddButtonName() {
        return $this->getId() . "_agregar";
    }
    
    public function isAddButtonClicked() {
        $request = Request::createFromGlobals();
        return ($request->request->get($this->findForm()->getName())[$this->getAddButtonName()]!=NULL);
    }
    
    public function valueMatches($value) {
        if(is_array($this->getValue())) {
            foreach($this->getValue() as $v) {
                if($v==$value) {
                    return true;
                }
            }
            return false;
        } else {
            return ($this->getValue() == $value);
        }
    }
    /**
     * 
     * @return \Administration\Data\Template\FormButton
     */
    public function getAddButton() {
        return $this->addButton;
    }
    
    public function getSubmitOnChange() {
        return $this->submitOnChange;
    }

    public function setSubmitOnChange($submitOnChange) {
        $this->submitOnChange = $submitOnChange;
        return $this;
    }



}
