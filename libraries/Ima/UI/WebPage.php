<?php

namespace Ima\UI;

use Administration\Data\ProjectData;
use Ima\Routing\Routing;
use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\Exceptions\IOException;
use MatthiasMullie\Minify\JS;
use MatthiasMullie\Minify\Minify;

/**
 * WebPage
 * @author lpena
 */
class WebPage extends \Ima\UI\HtmlRepresentation {
    
    private $title = "Website Title";
    
    private $author = "Luis Alfonso Peña Alaniz";
    
    private $description = "Website Description";
        
    private $themeColor = "#000000";
    
    private $minifiedStylesheet;
    
    private $minifiedJavascript;
    
    public function __construct() {        
        parent::__construct("libraries/Ima/views/WebPage.php");
        $this->addStylesheet(new \Ima\UI\Stylesheet("resources/Bootstrap/css/bootstrap.min.css"));
        $this->addStylesheet(new \Ima\UI\Stylesheet("resources/font-awesome-4.6.3/css/font-awesome.min.css"));
        $this->addStylesheet(new \Ima\UI\Stylesheet("resources/Bootstrap/css/colors.css"));
        $this->addJavascript(new \Ima\UI\Javascript("resources/jQuery/js/jquery-3.1.0.min.js"));        
        $this->addJavascript(new \Ima\UI\Javascript("resources/jQuery/js/jQueryRotate.js"));
        $this->addJavascript(new \Ima\UI\Javascript("resources/Bootstrap/js/bootstrap.min.js"));
        $this->addJavascript(new \Ima\UI\Javascript("resources/Bootstrap/js/ie10-viewport-bug-workaround.js"));
        $this->minifiedStylesheet = new \Ima\UI\Stylesheet('resources/Cache/css/' . Routing::getRouteName() . '.min.css');
        $this->minifiedJavascript = new \Ima\UI\Javascript('resources/Cache/js/' . Routing::getRouteName() . '.min.js');
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getThemeColor() {
        return $this->themeColor;
    }

    public function setThemeColor($themeColor) {
        $this->themeColor = $themeColor;
    }
    /**
     * Gets the minified stylesheet html representation
     * @return \Ima\UI\Stylesheet
     */
    public function getMinifiedStyleSheet() {
        return $this->minifiedStylesheet;
    }
    /**
     * Gets the minified javascript html representation
     * @return \Ima\UI\Javascript
     */
    public function getMinifiedJavascript() {
        return $this->minifiedJavascript;
    }
    /**
     * Override Output, check if js and css file exists and create if not
     */
    public function output() {        
        $this->minifyFiles($this->getStylesheets(), new CSS(), $this->minifiedStylesheet,!((new ProjectData(false))->getCacheCss()));
        $this->minifyFiles($this->getJavascripts(), new JS(), $this->minifiedJavascript,!((new ProjectData(false))->getCacheJs()));
        parent::output();
    }

    /**
     * Minifies the provided files with the given minifier, and saves the file if its not found
     * @param array $files
     * @param Minify $minifier
     * @param \Ima\UI\ReferencedHtmlRepresentation $destinyFile
     */
    private function minifyFiles(array $files,Minify $minifier,  \Ima\UI\ReferencedHtmlRepresentation $destinyFile,$forceSave=false) {        
        if(!file_exists($destinyFile->getPath()) || $forceSave) {            
            /* @var $file \Ima\UI\ReferencedHtmlRepresentation */
            foreach($files as $file) {
                $minifier->add($file->getPath());
            }           
            try {
                $dirname = dirname($destinyFile->getPath());
                if (!is_dir($dirname))
                {
                    mkdir($dirname, 0755, true);
                }
                @unlink($destinyFile->getPath());
                $minifier->minify($destinyFile->getPath());
            } catch(IOException $ex) {
                $error = $ex->getMessage();
                echo $error;
            }
        }
    }
}
