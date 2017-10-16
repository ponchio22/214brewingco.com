<?php

namespace Administration\Data\Template;

use Ima\Routing\Routing;
use Ima\UI\Form;

/**
 * EmptyForm
 * @author lpena
 */
class EmptyForm extends Form {
        
    
    public function __construct($name, $routeName = '', array $fields = array()) {
        parent::__construct($name, $routeName, $fields, '');
        $this->htmlFile = 'bundles/Administration/views/Ajax/EmptyForm.php';
        $this->addAttribute(["data-root"=>Routing::getRoot(true)]);
    }    
    
}
