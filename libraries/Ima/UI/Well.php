<?php

namespace Ima\UI;

/**
 * Well
 * @author LuisAlfonso
 */
class Well extends HtmlRepresentation {    
    
    public function __construct($id,$text="") {
        parent::__construct("libraries/Ima/views/Well.php");        
        $this->setText($text);
        $this->addAttribute(["id"=>$id]);
    }
}
