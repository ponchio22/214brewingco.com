<?php

namespace Administration\Data\Template;

use Administration\Data\Template\SimpleFormField;
use DateTime;
use Ima\UI\FormField;
use Ima\UI\Javascript;
use Ima\UI\Stylesheet;

class SimpleFormDateField extends SimpleFormField {
    
    public function __construct($id, $name, $label, $value = '', $placeholder = '') {
        parent::__construct($id, $name, $label, FormField::DATE, $value, $placeholder);
        $this->htmlFile = 'bundles/Administration/views/Ajax/SimpleFormDateField.php';
        $this->addJavascript(new Javascript("resources/Administration/js/SimpleFormDateField.js"));
        $this->addJavascript(new Javascript("resources/Bootstrap/js/bootstrap-datepicker.js"));
        $this->addStylesheet(new Stylesheet("resources/Bootstrap/css/datepicker.css"));
    }
    /**
     * Set the date for the field
     * @param DateTime $date
     */
    public function setValue($date) {
        if(gettype($date)=="string") {
            $cdate = new DateTime($date);
        } else {
            $cdate = $date;
        }
        $this->value = $cdate->format('m/d/Y');
        return $this;
    }
}
