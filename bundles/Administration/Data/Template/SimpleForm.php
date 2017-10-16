<?php

namespace Administration\Data\Template;

use Administration\Data\Template\FormButton;
use Administration\Data\Template\SimpleFormField;
use Ima\UI\Form;
use Ima\UI\FormFieldInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
/**
 * Description of SimpleForm
 *
 * @author LuisAlfonso
 */
class SimpleForm extends Form {
    /**
     *
     * @var FormButton
     */
    private $guardarButton;
    /**
     *
     * @var FormButton
     */
    private $returnButton;
    /**
     * 
     * @var type 
     */
    protected $idField;
    /**
     * Creates a new simple form
     * @param string $name Name of the form
     * @param string $routeName Route name of the action for the form
     * @param array $fields Array of fields
     */
    public function __construct($name, $routeName = '', array $fields = array()) {
        parent::__construct($name, $routeName, $fields);
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleForm.php';
        $this->guardarButton = new FormButton('guardar', 'guardar', 'Guardar');
        $this->returnButton = new FormButton('regresar', 'regresar', 'Regresar');
        $this->returnButton->setVisible($this->hasPreviousUrlAvailable());
        $this->returnButton->setForm($this);
        $this->guardarButton->setForm($this);
        $this->idField = new SimpleFormField('id', 'id', '', FormFieldInterface::INPUT_TEXT, '');
        $this->idField->setVisible(false);
        $this->addItem($this->idField);
    }    
    
    public function showReturnButton() {
        return ($this->request->query->get('url')!=NULL);
    }
    
    public function getReturnButtonName() {
        return $this->returnButton->getName();
    }
    
    public function isReturnButtonClicked() { 
        return $this->isButtonClicked($this->returnButton->getName());        
    }
    /**
     * 
     * @return FormButton
     */
    public function getGuardarButton() {
        return $this->guardarButton;
    }
    /**
     * 
     * @return FormButton
     */
    public function getReturnButton() {
        return $this->returnButton;
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
    }
    /**
     * 
     * @return SimpleFormField
     */
    public function getIdField() {
        return $this->idField;
    }

}
