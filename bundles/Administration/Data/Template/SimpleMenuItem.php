<?php

namespace Administration\Data\Template;

use Ima\UI\HtmlRepresentation;

/**
 * Description of SimpleMenuItem
 *
 * @author LuisAlfonso
 */
class SimpleMenuItem extends HtmlRepresentation {
    
    private $routeNames;
    
    private $text;
    
    private $visibleOnlyWhenUsed = false;  
    
    public function __construct(array $routeNames,$text,$visibleOnlyWhenUsed=false) {
        parent::__construct("");
        $this->routeNames = $routeNames;
        $this->text = $text;
        $this->visibleOnlyWhenUsed = $visibleOnlyWhenUsed;
    }
    
    public function getRouteNames() {
        return $this->routeNames;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function getVisibleOnlyWhenUsed() {
        return $this->visibleOnlyWhenUsed;
    }
}
