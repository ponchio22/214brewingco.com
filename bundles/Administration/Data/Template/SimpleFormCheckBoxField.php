<?php

namespace Administration\Data\Template;

use Ima\UI\FormField;
use Symfony\Component\HttpFoundation\Request;
/**
 * Description of SimpleFormCheckBoxField
 *
 * @author lpena
 */
class SimpleFormCheckBoxField extends FormField {
    
    private $checked = FALSE;
    
    private $submitOnChange = FALSE;
    
    private $useGlobals = TRUE;
    
    public function __construct($id, $name, $label, $selected = false, $submitOnChange=false,$visible = true) {
        parent::__construct($id, $name, $label, FormField::CHECKBOX, '', '', $visible, '');
        $this->checked = $selected;
        $this->submitOnChange = $submitOnChange;
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormCheckBoxField.php';
    }
    
    /**
     * Set the selected property
     * @param boolean $selected
     */
    public function setChecked($selected) {
        $this->useGlobals = FALSE;
        $this->checked = $selected;
        return $this;
    }
    /**
     * 
     * @return Boolean
     */
    public function getChecked($useGlobals = false) {
        $this->useGlobals = ($useGlobals)? true:$this->useGlobals;
        if($this->useGlobals) {
            $form = $this->findForm();
            $request = Request::createFromGlobals();
            if($form != NULL) {
                return (isset($request->request->get($form->getName())[$this->getName()]) && $request->request->get($form->getName())[$this->getName()]=="on")? TRUE:FALSE;
            } else {
                return FALSE;
            }
        } else {            
            return ($this->checked=="on")?true:false;
        }
    }
    /**
     * Overrides the set Value default option and use the selected
     * @param boolean $selected
     */
    public function setValue($selected) {
        $this->setChecked($selected==true);
        return $this;
    }
    /**
     * Override of the getValue default option and use the getSelected
     * @return type
     */
    public function getValue() {
        return $this->getChecked();
    }
    /**
     * 
     * @param boolean $submitOnChange
     */
    public function setSubmitOnChange($submitOnChange) {
        $this->submitOnChange = $submitOnChange;
        return $this;
    }
    /**
     * 
     * @return boolean
     */
    public function getSubmitOnChange() {
        return $this->submitOnChange;
    }
    
}
