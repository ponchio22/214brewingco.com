<?php

namespace Ima\UI;

use Ima\MySql\MySqlObject;
use Ima\Routing\Routing;
use Ima\UI\FormField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Form
 *
 * @author LuisAlfonso
 */
class Form extends \Ima\UI\HtmlRepresentation {
    
    protected $name;
    
    protected $routeName;
    /**
     *
     * @var Request
     */
    protected $request;
    
    protected $attributes = [];
        
    /**
     * Creates a new form
     * @param string $name Name of the form
     * @param string $routeName Route name of the action for the form
     * @param array $fields Array of fields
     */
    public function __construct($name,$routeName='',array $fields=array(),$htmlFile='') {
        parent::__construct($htmlFile);
        $this->name = $name;
        $this->items = $fields;
        $this->request = Request::createFromGlobals();
        $this->routeName = $routeName;
    }
    public function addAttribute($attribute) {
        array_push($this->attributes,$attribute);
    }
    /**
     * 
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }
    /**
     * Sets the value to the fields based on the tag found in the request object
     */
    public function updateFormFieldsFromRequest() {        
        $data = $this->getDataFromRequest();
        /* @var $field FormField */
        foreach($this->items as $field) {
            @$field->setValue($data[$field->getName()]);
        }
        return $this;
    }
    /**
     * 
     * @param type $name
     * @return \Ima\UI\Form
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    /**
     * Gets the name of the form
     * @return string Name of the form
     */
    public function getName() {
        return $this->name;        
    }
    
    /**
     * Get the fields of the form
     * @return array
     */
    public function getFields() {
        return $this->getItems();
    }
    
    public function getCollapseId() {
        return $this->getName() . "_collapse";
    }
    
    /**
     * Set the route name to be used in the action of the form
     */
    public function setRouteName($routeName) {
        $this->routeName = $routeName;
        return $this;
    }
    
    /**
     * Gets the route name to be used in the action of the form
     * @return type
     */
    public function getRouteName() {
        return $this->routeName;
    }
    
    /**
     * Gets the field according to the given id
     * @param string $id Id of the field
     * @return FormField
     */
    public function get($id) {
        /* @var $field FormField */
        foreach($this->items as $field) {
            if($field->getId() == $id) {
                return $field;
            }
        }
    }
    
    /**
     * Gets the action value for the form
     * @return type
     */
    public function getAction() {
        return Routing::getPath($this->routeName, Routing::getParameters(),$this->request->query->all());
    }
    
    /**
     * Adds a form field to the array
     * @param FormField $field
     */
    public function addItem($field) {
        if(method_exists($field, "setForm")) {
            $field->setForm($this);        
        }        
        return parent::addItem($field);
    }
    /**
     * Gets the data from the submitted request based on the form name
     * @return array Form data from the request
     */
    public function getDataFromRequest() {
        return $this->request->request->get($this->name);
    }
    
    /**
     * Stores the form data so it can be used in another page or time
     * @param string $formName 
     * @param array $data
     */
    public function preserveValues() {
        $request = Request::createFromGlobals();
        $data = $request->request->get($this->name);
        $session = new Session();
        $session->set($this->name, $data);
        return $this;
    }
    
    /**
     * Loads the saved form data
     * @return array Data of the form
     */
    public function loadPreservedFormData($removeData=true) {
        $session = new Session();
        $data = $session->get($this->name);
        if($removeData) $session->remove($this->name);
        return $data;
    }
    /**
     * 
     * @param type $name
     * @return type
     */
    public function isButtonClicked($name){        
        return isset($this->request->request->get($this->name)[$name]);
    }
    
    public function getFormData(Request $request) {
        $form = $request->request->get($this->name);
        $files = $request->files->get($this->name);        
        if(is_array($files)) {
            $return = array_merge($form,$files);
        } else {
            $return = $form;
        }
        if($return == NULL) {
            $return = array();
        }
        return $return;
    }
    
    public function GetFormObject(Request $request,MySqlObject $object) {
        $object->associateArray($this->GetFormData($request));
        return $object;
    }
    
    public function hasPreviousUrlAvailable() {
        return ($this->request->query->get('url')!=NULL);
    }
    
    public function updateObjectFromRequest() {
        $this->updateObjectFromArray($this->getDataFromRequest());
        return $this;
    }
}
