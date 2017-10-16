<?php
namespace Administration\Data\Template;

use Ima\UI\FormField;
use Ima\UI\FormFieldInterface;

/**
 * EmptyFormField
 * @author lpena
 */
class EmptyFormField extends FormField implements FormFieldInterface {
    
    public function __construct($id, $name) {
        parent::__construct($id, $name,'');
        $this->htmlFile = 'bundles/Administration/views/Ajax/EmptyFormField.php';
    }
    
}
