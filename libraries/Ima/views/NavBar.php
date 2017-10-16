<?php

use Ima\UI\NavBar;
use Ima\UI\NavBarItem;

/* @var $object NavBar */
$leftItems = array();
$rightItems = array();
/* @var $item NavBarItem */
foreach ($object->getItems() as $item) {
    if(!$item->getAlignRight()) {
        $leftItems[] = $item;
    } else {
        $rightItems[] = $item;
    }
}
?>
<!-- NavBar -->
<nav class="navbar navbar-default <?php echo $object->getCssclass();?> <?php echo $object->getPosition();?>" role="navigation" id='<?php echo $object->getId();?>'>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            if($object->getBrand() != NULL) {
                $object->getBrand()->output();
            }
            ?>            
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php
            /* @var $item NavBarItem */
            foreach($leftItems as $item){
                $item->output();
            }
            ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
            /* @var $item NavBarItem */
            foreach($rightItems as $item){
                $item->output();
            }
            ?>
            </ul>
        </div>
    </div>
</nav>
