<?php

namespace Administration\Data\Template;

use Ima\Routing\Routing;
use Ima\UI\HtmlRepresentation;


/**
 * Menu
 * @author lpena
 */
class Menu extends HtmlRepresentation {
    
    private $id;
    
    private $parameters;
    
    public function __construct($id="menu") {
        $this->id = $id;
        parent::__construct("bundles/Administration/views/Ajax/Menu.php"); 
        $this->parameters = Routing::getParameters();
    }
    
    public function addItem(\Administration\Data\Template\MenuItem $item) {   
        $r = parent::addItem($item);
        $item->setParameters($this->parameters);
        return $r;
    }
    
    public function setParameters($parameters) {
        /* @var $item \Administration\Data\Template\MenuItem */
        foreach($this->items as $item) {
            $item->setParameters($parameters);
        }
        return $this;
    }
    
    public function getId() {
        return $this->id;
    }


    
}
