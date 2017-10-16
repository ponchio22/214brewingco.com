<?php

namespace Administration\Data\Template;

use Ima\UI\HtmlRepresentation;

/**
 * Javascript
 * @author lpena
 */
class Css extends HtmlRepresentation {
    
    private $path;
    
    public function __construct($path) {
        parent::__construct('');
        $this->path = $path;
    }
    
    public function getPath() {
        return $this->path;
    }
}
