<?php

namespace Administration\Controls;

use Finanzas\Controls\BalanceInformationData;
use Finanzas\Controls\LastMonthResume;
use Ima\UI\HtmlRepresentation;

/**
 * HomePageContent
 * @author lpena
 */
class HomePageContent extends HtmlRepresentation {    
    /**
     *
     * @var BalanceInformationData
     */
    private $balanceInformation;
    /**
     *
     * @var LastMonthResume
     */
    private $lastMonthResume;
    
    public function __construct() {
        parent::__construct("bundles/Administration/views/Ajax/HomePageContent.php");
        $this->balanceInformation = new BalanceInformationData();        
        $this->lastMonthResume = new LastMonthResume();
        $this->addItem($this->balanceInformation);
        $this->addItem($this->lastMonthResume);
    }
    /**
     * 
     * @return BalanceInformationData
     */
    public function getBalanceInformation() {
        return $this->balanceInformation;
    }
    /**
     * 
     * @return LastMonthResume
     */
    public function getLastMonthResume() {
        return $this->lastMonthResume;
    }


}
