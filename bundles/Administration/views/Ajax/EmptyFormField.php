<?php

use Administration\Data\Template\EmptyFormField;
/* @var $object EmptyFormField */
?>
<div id="<?php echo $object->getId();?>" name="<?php echo $object->getName();?>" class="<?php echo ($object->getVisible())? "":"hidden";?>"></div>