<?php

namespace Ima\UI;

/**
 * ReferencedHtmlRepresentation
 * @author lpena
 */
class ReferencedHtmlRepresentation extends \Ima\UI\HtmlRepresentation{
    
    private $path;
    
    public function __construct($path,$htmlFile) {
        parent::__construct($htmlFile);
        $this->path = $path;
    }
    
    /**
     * Reference path of the file
     * @return string
     */
    public function getPath() {
        return $this->path;
    }
    
}
