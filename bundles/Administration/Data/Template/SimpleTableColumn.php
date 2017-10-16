<?php
namespace Administration\Data\Template;

/**
 * Description of SimpleTableColumn
 *
 * @author LuisAlfonso
 */
class SimpleTableColumn {
    
    private $name;
    
    private $text;
    
    public function __construct($name,$text) {
        $this->name = $name;
        $this->text = $text;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getText() {
        return $this->text;
    }
}
