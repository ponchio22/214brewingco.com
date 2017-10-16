<?php

namespace Website\Controls;

use Ima\UI\HtmlRepresentation;

/**
 * HomeText
 * @author LuisAlfonso
 */
class HomeText extends HtmlRepresentation {
    
    public function __construct() {
        parent::__construct("bundles/Website/views/HomeText.php");        
    }
}
