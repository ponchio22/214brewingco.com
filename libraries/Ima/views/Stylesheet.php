<?php

use Ima\Routing\Routing;
use Ima\UI\Stylesheet;

/* @var $object Stylesheet */
?><link rel="stylesheet" href="<?php echo Routing::getRoot(true)?>/<?php echo $object->getPath();?>"/>
