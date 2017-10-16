<?php

namespace Administration\Controls;

use Ima\UI\FormField;
use Ima\UI\Javascript;

/**
 * Pagination
 * @author lpena
 */
class PaginationFormField extends FormField{
    
    private $limit;
    
    private $offset;
    
    private $total;
    
    private $extraParameters = [];
    
    private $followLinks = true;
    
    public function __construct($id,$total=0,$limit=null,$offset=0) {
        parent::__construct($id, "", "");
        $this->setHtmlFile("bundles/Administration/views/Ajax/PaginationFormField.php");
        $this->addJavascript(new Javascript("resources/Administration/js/PaginationFormField.js"));        
    }
    
    public function getLimit() {
        return $this->limit;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function setOffset($offset) {
        $this->offset = $offset;
        return $this;
    }

    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }
    
    public function getExtraParameters() {
        return $this->extraParameters;
    }

    public function setExtraParameters($extraParameters) {
        $this->extraParameters = $extraParameters;
        return $this;
    }
    
    public function getFollowLinks() {
        return $this->followLinks;
    }

    public function setFollowLinks($followLinks) {
        $this->followLinks = $followLinks;
        return $this;
    }



}
