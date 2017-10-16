<?php

namespace Ima\UI;

/**
 * NavBarItem
 * @author lpena
 */
class NavBarItem extends \Ima\UI\HtmlRepresentation {
    
    private $isDropDown = false;
    
    private $label = "";
    
    private $isActive = false;    
    
    private $href;
    
    private $alignRight = false;
    
    private $iconClass = "";
    
    public function __construct($label,$href="#") {
        parent::__construct("libraries/Ima/views/NavBarItem.php");
        $this->label = $label;
        $this->href = $href;
    }
    
    public function getIsDropDown() {
        return $this->isDropDown;
    }
    
    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }
    
    /**
     * 
     * @param NavBarItem $item
     */
    public function addItem($item) {        
        $this->isDropDown = true;
        return parent::addItem($item);
    }
    
    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }
    
    public function getHref() {
        return $this->href;
    }

    public function setHref($href) {
        $this->href = $href;
        return $this;
    }

    public function getAlignRight() {
        return $this->alignRight;
    }
    /**
     * 
     * @param bool $alignRight True for right alignment
     * @return \Ima\UI\NavBarItem
     */
    public function setAlignRight($alignRight) {
        $this->alignRight = $alignRight;
        return $this;
    }

    public function getIconClass() {
        return $this->iconClass;
    }

    public function setIconClass($iconClass) {
        $this->iconClass = $iconClass;
        return $this;
    }
}
