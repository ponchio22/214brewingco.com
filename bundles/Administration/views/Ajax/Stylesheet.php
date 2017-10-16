<?php

use Administration\Data\Template\Stylesheet;
use Ima\Routing\Routing;

/* @var $object Stylesheet */
?>  <link rel="stylesheet" href="<?php echo Routing::getRoot(true)?>/<?php echo $object->getPath();?>"/>

