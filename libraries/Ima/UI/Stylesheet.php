<?php

namespace Ima\UI;

/**
 * Stylesheet
 * @author lpena
 */
class Stylesheet extends \Ima\UI\ReferencedHtmlRepresentation {
    
    public function __construct($path) {
        parent::__construct($path,'libraries/Ima/views/Stylesheet.php');
    }
    
}