<?php

namespace Ima\UI;

use Administration\Data\Template\Stylesheet;

/**
 * PageHeader
 * @author lpena
 */
class PageHeader extends \Ima\UI\HtmlRepresentation {
    
    private $title;
    
    public function __construct($htmlFile="Ima/views/PageHeader.php") {
        parent::__construct($htmlFile);
        $this->addStylesheet(new Stylesheet("/resources/Bootstrap/css/bootstrap.min.css"));
        $this->addStylesheet(new Stylesheet("/resources/Administration/css/administration.css"));
        $this->addStylesheet(new Stylesheet("/resources/Bootstrap/css/datepicker.css"));
        $this->addStylesheet(new Stylesheet("/resources/Bootstrap/css/DateTimePicker.css"));
        $this->addStylesheet(new Stylesheet("/resources/font-awesome-4.6.3/css/font-awesome.min.css"));
    }
    /**
     * Gets the title of the page header
     * @return type
     */
    public function getTitle() {
        return $this->title;
    }
    /**
     * Set the title for the page header
     * @param type $title
     * @return \Ima\UI\PageHeader
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }


}
