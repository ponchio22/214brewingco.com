<?php

namespace Ima\UI;

/**
 * NavBar
 * @author lpena
 */
class NavBar extends \Ima\UI\HtmlRepresentation {
    
    private $position;    
    
    private $id;
    
    private $brand;
    
    public function __construct($id="navbar") {
        parent::__construct("libraries/Ima/views/NavBar.php");
        $this->addJavascript(new Javascript("resources/Ima/js/Navbar.js"));
        $this->position = \Ima\UI\NavBarPosition::FIXED_TOP;
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

        
    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }
    /**
     * 
     * @param \Ima\UI\NavBarItem $item
     * @return \Ima\UI\NavBarItem
     */
    public function addItem(\Ima\UI\NavBarItem $item) {
        return parent::addItem($item);
    }
    /**
     * 
     * @return \Ima\UI\NavBarBrand
     */
    public function getBrand() {
        return $this->brand;
    }
    /**
     * 
     * @param \Ima\UI\NavBarBrand $brand
     */
    public function setBrand(\Ima\UI\NavBarBrand $brand) {
        $this->brand = $brand;
        return $this;
    }


}

