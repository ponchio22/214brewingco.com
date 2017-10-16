<?php

use Administration\Data\Template\FormButton;
/* @var $object FormButton */
?>
<button type="submit" id="<?php echo $object->getId();?>" <?php foreach($object->getAttributes() as $attr) { echo key($attr) . "='".$attr[key($attr)]."' "; };?>name="<?php echo $object->findForm()->getName();?>[<?php echo $object->getName();?>]" class="btn <?php echo ($object->getPrimary())? ' btn-primary':'btn-default';?><?php echo " ".$object->getCssclass(); ?>" style="<?php echo ($object->getVisible())? '':'display:none;';?>" <?php if(!$object->getEnabled()) echo "disabled";?>><?php echo $object->getLabel();?></button>
