<?php

namespace Ima\UI;

/**
 * Javascript
 * @author lpena
 */
class Javascript extends \Ima\UI\ReferencedHtmlRepresentation {
    
    public function __construct($path) {
        parent::__construct($path,'libraries/Ima/views/Javascript.php');        
    }
    
}