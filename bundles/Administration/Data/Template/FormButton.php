<?php
namespace Administration\Data\Template;

use Ima\UI\FormField;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of FormButton
 *
 * @author lpena
 */
class FormButton extends FormField {
    
    private $primary = false;
    
    public function __construct($id, $name, $label, $visible = true, $primary=false) {
        parent::__construct($id, $name, $label, FormField::BUTTON, '', '', $visible);
        $this->htmlFile = 'bundles/Administration/views/Ajax/FormButton.php';
        $this->primary = $primary;
    }
    /**
     * Gets the primary property
     * @return Boolean
     */
    public function getPrimary() {
        return $this->primary;
    }
    /**
     * Sets the primary property
     * @param Boolean $primary
     */
    public function setPrimary($primary) {
        $this->primary = $primary;
        return $this;
    }
    
    public function isClicked() {
        $form = $this->findForm();
        $request = Request::createFromGlobals();        
        if($form != NULL) {
            return isset($request->request->get($form->getName())[$this->getName()]);
        } else {
            return false;
        }
    }
    
}
