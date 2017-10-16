<?php

namespace Ima\UI;

/**
 * Page
 * @author lpena
 */
class Page extends \Ima\UI\HtmlRepresentation {
    
    private $title = "";
    
    private $description = "";    
    
    public function __construct($htmlFile="libraries/Ima/views/Page.php") {
        parent::__construct($htmlFile);
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}