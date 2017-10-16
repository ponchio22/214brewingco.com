<?php

use Ima\Routing\Routing;
use Ima\UI\NavBarBrand;

/* @var $object NavBarBrand */
if($object->hasIcon()):
?>
<a class="navbar-brand <?php echo $object->getCssclass();?>" rel="home" href="<?php echo $object->getHref();?>" title="<?php echo $object->getBrandName();?>">
    <img src="<?php echo Routing::getRoot(true) . "/" .  $object->getBrandIconPath();?>">
</a>
<?php
endif;
?>
<a class="navbar-brand hidden-sm <?php echo $object->getCssclass();?>" href="<?php echo $object->getHref();?>"><?php echo $object->getBrandName();?></a>