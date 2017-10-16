<?php

namespace Website\Controls;

use Ima\UI\HtmlRepresentation;

/**
 * HomeHtml
 * @author LuisAlfonso
 */
class HomeHtml extends HtmlRepresentation{
    
    public function __construct() {
        parent::__construct("bundles/Website/views/HomeHtml.php");
    }
}
