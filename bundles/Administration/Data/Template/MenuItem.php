<?php

namespace Administration\Data\Template;

use Ima\Routing\Routing;
use Ima\UI\HtmlRepresentation;
use Ima\UI\Javascript;

/**
 * MenuItem
 * @author lpena
 */
class MenuItem extends HtmlRepresentation {
    
    private $id = "";
    
    private $text;
    
    private $selected;
    
    private $visible;
    
    private $route;
    
    private $parameters;
    
    private $showSpinner;
    
    public function __construct($text,$route,$selected,$visible,$parameters=array(),$showSpinner=true) {
        parent::__construct("bundles/Administration/views/Ajax/MenuItem.php");
        $this->addJavascript(new Javascript("resources/Administration/js/MenuItem.js"));
        $this->text = $text;
        $this->selected = $selected;
        $this->route = $route;
        $this->visible = $visible;
        $this->parameters = $parameters;
        $this->showSpinner = $showSpinner;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    
    
    public function getText() {
        return $this->text;
    }

    public function getSelected() {
        return $this->selected;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function setSelected($selected) {
        $this->selected = $selected;
        return $this;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
        return $this;
    }
    
    public function getRoute() {
        return $this->route;
    }

    public function setRoute($route) {
        $this->route = $route;
        return $this;
    }
    
    public function getLink() {
        if($this->route == NULL) {
            return "#";
        } else {
            return Routing::getPath($this->route,$this->parameters);
        }
    }

    public function getParameters() {
        return $this->parameters;
    }

    public function setParameters($parameters) {
        $this->parameters = $parameters;
    }

    public function getShowSpinner() {
        return $this->showSpinner;
    }

    public function setShowSpinner($showSpinner) {
        $this->showSpinner = $showSpinner;
        return $this;
    }




}
