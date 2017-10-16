<?php

use Ima\UI\NavBarItem;

/* @var $object NavBarItem */
if(!$object->getIsDropDown()):
?>
<li class="navBarItem <?php echo ($object->getIsActive())?"active":"";?> <?php echo $object->getCssclass();?>" style="<?php echo (!$object->getVisible())? "display:none":"";?>" ><a href="<?php echo $object->getHref();?>"><?php if($object->getIconClass()!=""):?><span class="glyphicon <?php echo $object->getIconClass();?>"></span> <?php endif; echo $object->getLabel();?></a></li>
<?php
else:
?>
<li class="dropdown <?php echo ($object->getIsActive())?"active":"";?> <?php echo $object->getCssclass();?>" style="<?php echo (!$object->getVisible())? "display:none":"";?>">
    <a href="<?php echo $object->getHref();?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon <?php echo $object->getIconClass();?>"></span><span> <?php echo $object->getLabel();?> </span><span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
<?php
    /* @var $item NavBarItem */
    foreach ($object->getItems() as $item) {
        echo "\t\t";
        $item->output();
    }
?>
    </ul>
</li>
<?php
endif;
?>