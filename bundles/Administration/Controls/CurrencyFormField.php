<?php
namespace Administration\Controls;

use Administration\Data\Template\SimpleFormField;
use Ima\Data\NumberFormat;
use Ima\UI\Javascript;
use Ima\UI\Stylesheet;

class CurrencyFormField extends SimpleFormField {
    
    private $useCashSumCounter = false;
    /**
     * Constructor
     * @param type $id
     * @param type $name
     * @param type $label
     * @param type $value
     * @param type $placeholder
     */
    public function __construct($id, $name, $label, $value = '', $placeholder = '') {
        parent::__construct($id, $name, $label, SimpleFormField::CURRENCY, $value, $placeholder);
        $this->htmlFile = 'bundles/Administration/views/Ajax/CurrencyFormField.php';
        $this->addJavascript(new Javascript("resources/Administration/js/CurrencyFormField.js"));
        $this->addStylesheet(new Stylesheet("resources/Administration/css/CurrencyFormField.css"));
    }
    /**
     * 
     * @param type $value
     * @return \Administration\Data\Template\CurrencyFormField
     */
    public function setValue($value) {
        parent::setValue(NumberFormat::money(floatval(str_replace(",","",$value))));
        return $this;
    }
    
    public function setUseCashSumCounter($useCashSumCounter) {
        $this->useCashSumCounter = $useCashSumCounter;
        return $this;
    }
    
    public function getUseCashSumCounter() {
        return $this->useCashSumCounter;
    }



}
