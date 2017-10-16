<?php

use Administration\Controls\HomePageContent;
use Ima\UI\HtmlRepresentation;
/* @var $object HomePageContent */
/* @var $item HtmlRepresentation */

?><div class="col-sm-4" style="padding:0px;margin:0px;"><?php $object->getBalanceInformation()->output();?></div>
<div class="col-sm-1 hidden-xs" style="padding:0px;margin:0px;width: 10px;height:1px;"></div>
<div class="col-sm-7" style="padding:0px;margin:0px;"><?php $object->getLastMonthResume()->output();?></div>