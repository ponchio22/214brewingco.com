<?php

namespace Ima\UI;

/**
 * CurrencyLabel
 * @author lpena
 */
class CurrencyLabel extends \Ima\UI\HtmlRepresentation {
    
    private $amount;
    
    public function __construct($amount) {
        parent::__construct("libraries/Ima/views/CurrencyLabel.php");
        $this->amount = $amount;
    }
    /**
     * Amount of money
     * @return string
     */
    public function getAmount() {
        return $this->amount;
    }
    /**
     * Sets the amount of money to be shown
     * @param type $amount
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }
}
