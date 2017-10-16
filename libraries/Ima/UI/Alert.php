<?php

namespace Ima\UI;

/**
 * Alert
 * @author lpena
 */
class Alert extends \Ima\UI\HtmlRepresentation {
   
    public function __construct() {
        parent::__construct("libraries/Ima/views/Alert.php");
        $this->addCssClass("alert");
    }
}
