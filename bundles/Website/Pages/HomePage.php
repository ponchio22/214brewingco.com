<?php

namespace Website\Pages;

use Ima\UI\Stylesheet;
use Ima\UI\WebPage;
use Website\Controls\HomeText;

/**
 * HomeHtml
 * @author LuisAlfonso
 */
class HomePage extends WebPage {
    
    public function __construct() {
        parent::__construct();
        $this->setTitle("Project Title");
        $this->addItem(new HomeText());
        $this->addStylesheet(new Stylesheet("resources/Website/css/Website.css"));
    }
}
