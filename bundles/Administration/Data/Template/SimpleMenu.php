<?php

namespace Administration\Data\Template;

use Administration\Data\Template\SimpleMenuItem;
use Ima\UI\HtmlRepresentation;

/**
 * Description of SimpleMenu
 *
 * @author LuisAlfonso
 */
class SimpleMenu extends HtmlRepresentation {
    
    const FILE = 'bundles/Administration/views/Ajax/SimpleMenu.php';
    
    public function __construct(array $items = array()) {
        parent::__construct(SimpleMenu::FILE);
        $this->setItems($items);
    }    
    /**
     * 
     * @param SimpleMenuItem $item
     * @return type
     */
    public function addItem(SimpleMenuItem $item) {        
        return parent::addItem($item);
    }
}
