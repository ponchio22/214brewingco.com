<?php
use Ima\UI\CurrencyLabel;
/* @var $object CurrencyLabel */
?><span>$</span><span class="pull-right"><?php echo number_format($object->getAmount(),2,".",",");?></span>