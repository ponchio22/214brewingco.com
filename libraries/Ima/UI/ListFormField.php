<?php

namespace Ima\UI;

/**
 * ListFormField
 * @author LuisAlfonso
 */
class ListFormField extends \Ima\UI\FormField {
    
    protected $limit = null;
    
    protected $offset = null;
    
    public $listItems = array();
    
    public $allItemsCount = 0;
    
    public function __construct($id, $name, $label, $type = '', $value = '', $placeholder = '', $visible = true, $htmlFile = '') {
        parent::__construct($id, $name, $label, $type, $value, $placeholder, $visible, $htmlFile);
    }
    
    public function getLimit() {
        return $this->limit;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setOffset($offset) {
        $this->offset = $offset;
    }

    public function getListItems() {
        return $this->listItems;
    }

    public function setListItems($listItems) {
        $this->listItems = $listItems;
        return $this;
    }
    
    function getAllItemsCount() {
        return $this->allItemsCount;
    }

    function setAllItemsCount($allItemsCount) {
        $this->allItemsCount = $allItemsCount;
    }
        
    public function getPages() {
        if($this->limit == null) {
            return 0;
        } else {
            return ceil(count($this->allItemsCount)/$this->limit);
        }
    }

}
