<?php

namespace Ima\UI;

/**
 * NavBarBrand
 * @author lpena
 */
class NavBarBrand extends \Ima\UI\HtmlRepresentation {
    
    private $brandIconPath = "";
    
    private $brandName = "";
        
    private $href = "#";
    
    public function __construct($brandName="Brand",$brandIconPath="",$href="#") {
        parent::__construct("libraries/Ima/views/NavBarBrand.php");
        $this->brandName = $brandName;
        $this->brandIconPath = $brandIconPath;
        $this->href = $href;
    }
    
    public function getBrandIconPath() {
        return $this->brandIconPath;
    }

    public function getBrandName() {
        return $this->brandName;
    }

    public function setBrandIconPath($brandIconPath) {
        $this->brandIconPath = $brandIconPath;
    }

    public function setBrandName($brandName) {
        $this->brandName = $brandName;
    }

    public function hasIcon() {
        return ($this->brandIconPath != "");
    }
    
    public function getHref() {
        return $this->href;
    }

    public function setHref($href) {
        $this->href = $href;
    }


    
}
