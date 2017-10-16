<?php

namespace Ima\UI;

/**
 * Icon
 * @author lpena
 */
class Icon extends \Ima\UI\HtmlRepresentation {
    
    private $path;
    
    public function __construct($path) {
        parent::__construct('libraries/Ima/views/Javascript.php');
        $this->path = $path;        
    }
    
    public function getPath() {
        return $this->path;
    }
}
