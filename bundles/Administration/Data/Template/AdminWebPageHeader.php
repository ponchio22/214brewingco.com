<?php
namespace Administration\Data\Template;

use Ima\UI\HtmlRepresentation;
/**
 * Description of SimplePageHeader
 *
 * @author LuisAlfonso
 */
class AdminWebPageHeader extends HtmlRepresentation {
    
    private $title;
    
    private $subtitle;
    
    public function __construct($title='',$subtitle='') {
        parent::__construct("bundles/Administration/views/Ajax/AdminWebPageHeader.php");
        $this->title = $title;
        $this->subtitle = $subtitle;
    }
    
    public function getTitle() {        
        return $this->title;
    }
    
    public function getSubtitle() {
        return $this->subtitle;
    }
    
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
        return $this;
    }
}
