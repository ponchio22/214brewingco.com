<?php

namespace Ima\UI;

use Ima\Routing\Routing;
use Ima\UI\Form;
use Ima\UI\FormFieldInterface;
use Ima\UI\HtmlRepresentation;
use Symfony\Component\HttpFoundation\Request;
/**
 * FormField
 *
 * @author LuisAlfonso
 */
class FormField extends HtmlRepresentation implements FormFieldInterface  {
    
    protected $id;
    
    protected $name;
    
    protected $label;
    
    protected $type;
    
    protected $placeholder = '';
    
    protected $value = '';
    
    protected $visible = '';
    
    protected $enabled = true;
    
    protected $hasError = false;
    
    protected $collapsable = false;
    
    protected $error = '';
    
    protected $form;
    
    private $outputOnlyInput = false;
    
    /**
     * Creates a new form field
     * @param type $id
     * @param type $name
     * @param type $label
     * @param type $type
     * @param type $value
     * @param type $placeholder
     * @param type $visible
     * @param type $viewFile
     */    
    public function __construct($id,$name,$label,$type='',$value='',$placeholder='',$visible=true,$htmlFile='') {
        $this->addJavascript(new \Ima\UI\Javascript("resources/Ima/js/FormField.js"));
        parent::__construct($htmlFile);        
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->type = ($type=='')? \Ima\UI\FormField::INPUT_TEXT:$type;
        $this->htmlFile = ($htmlFile=='')? 'bundles/Administration/views/Ajax/SimpleFormInputTextField.php':$htmlFile;        
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->visible = true;
        $this->addAttribute(["data-root"=> Routing::getRoot(true)]);
    }
    
    /**
     * Gets the id of the field
     * @return string
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Returns the name of the field with the form id reference in case its nested 
     * inside a form, if not returns only the name.
     * 
     * e.g. formId[fieldName] or fieldName
     * @return string
     */
    public function getFieldFormName() {
        $form = $this->findForm();
        if($form!=NULL) {
            return $form->getName() . "[".$this->getName()."]";
        } else {
            return $this->getName();
        }
    }
    
    /**
     * Gets the name of the field
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    /**
     * 
     * @return bool
     */
    public function getCollapsable() {
        return $this->collapsable;
    }
    /**
     * 
     * @param bool $collapsable
     */
    public function setCollapsable($collapsable) {
        $this->collapsable = $collapsable;
        return $this;
    }

        /**
     * Gets the label of the field
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }
    /**
     * 
     * @param type $label
     * @return \Ima\UI\FormField
     */
    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }
    /**
     * Gets the type of the field
     * @return int
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Set the value of the placeholder for the field
     * @param type $placeHolder
     */
    public function setPlaceHolder($placeHolder) {
        $this->placeholder = $placeHolder;
        return $this;
    }
    
    /**
     * gets the value of the placeholder of the field
     * @return type
     */
    public function getPlaceHolder() {
        return $this->placeholder;
    }
    
    /**
     * Set the value of the field
     * @param type $value
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
    
    /**
     * gets the value
     * @return type
     */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * Gets if its visible or not
     * @return type
     */
    public function getVisible() {
        return $this->visible;
    }
    
    /**
     * Sets if the field is visible of not
     * @param boolean $visible
     */
    public function setVisible($visible) {
        $this->visible = $visible;
        return $this;
    }
    /**
     * Set the enabled state of the field
     * @param type $enabled
     * @return \Ima\UI\FormField
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * Gets the enabled state of the field
     * @return boolean
     */
    public function getEnabled() {
        return $this->enabled;
    }
    /**
     * Error to set to the field
     * @param $error
     */
    public function setError($error) {
        $this->hasError = true;
        $this->error = $error;
        return $this;
    }
    /**
     * Get the error text for the field
     * @return String
     */
    public function getError() {
        return $this->error;
    }
    /**
     * Get the flag indicating if the field has errors in the validation
     * @return boolean
     */
    public function getHasError() {
        return $this->hasError;
    }
    /**
     * 
     * @return Form
     */
    public function findForm() {
        if($this->form!=NULL) {
            return $this->form;
        } else {
            return new Form("");
        }
    }
    /**
     * 
     * @param Form $form
     */
    public function setForm(Form $form) {
        $this->form = $form;
        /* @var $item \Ima\UI\FormField */
        foreach($this->items as $item) {
            if(method_exists($item, "setForm")) {
                $item->setForm($this->form);
            }
        }
        return $this;
    }
    /**
     * Add a field to the field and sets the form object
     * @param HtmlRepresentation $formField
     */
    public function addItem(HtmlRepresentation $formField) {
        return parent::addItem($formField);
    }
    
    public function clear() {
        $this->value = '';
        return $this;
    }
    /**
     * Updates the field value based on the post request
     * @return string
     */
    public function updateValueFromRequest() {
        $form = $this->findForm();
        $request = Request::createFromGlobals();        
        if($form != NULL) {
            return $request->request->get($form->getName())[$this->getName()];
        } else {
            return "";
        }    
    }
    
    public function getOutputOnlyInput() {
        return $this->outputOnlyInput;
    }

    public function setOutputOnlyInput($outputOnlyInput) {
        $this->outputOnlyInput = $outputOnlyInput;
        return $this;
    }
}
