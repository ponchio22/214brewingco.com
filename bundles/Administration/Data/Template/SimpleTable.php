<?php

namespace Administration\Data\Template;

use Administration\Data\Template\SimpleTableColumn;

/**
 * Description of SimpleTable
 *
 * @author LuisAlfonso
 */
class SimpleTable {
    
    const FILE = 'bundles/Administration/views/Ajax/SimpleTable.php';
    
    private $items = array();
    
    private $columns = array();
    
    public function __construct(array $items,array $columns = array(),$useObjectItems) {
        $this->items = $items;
        $this->columns = $columns;
    }
    
    public function addColumn(SimpleTableColumn $column) {
        $this->columns[] = $column;
    }
    
    public function clearColumns() {
        $this->columns = array();
    }
    
    public function getItems() {
        return $this->items;
    }
    
    public function addItem($item) {
        array_push($this->items, $item);
    }
    
    public function getColumns() {
        return $this->columns;
    }
}
