<?php

use Administration\Data\Template\SimpleFormTextAreaField;
 /* @var $object SimpleFormTextAreaField */
 ?>
<div class="form-row form-group <?php echo ($object->getHasError())?'has-error':''?>" style="<?php echo ($object->getVisible())?"":"display:none";?>">
    <label for="<?php echo $object->getId();?>"><?php echo $object->getLabel();?></label>
    <textarea id="<?php echo $object->getId();?>" name="<?php echo $object->findForm()->getName();?>[<?php echo $object->getName();?>]" class="form-control" rows="<?php echo $object->getRows();?>" <?php echo ($object->getEnabled())? '':'disabled';?>><?php echo $object->getValue();?></textarea>
    <?php if($object->getHasError()) :?>
    <span id="helpBlock2" class="help-block"><?php echo $object->getError();?></span>
    <?php endif;?>
</div>