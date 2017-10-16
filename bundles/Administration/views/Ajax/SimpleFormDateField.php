<?php
use Administration\Data\Template\SimpleFormDateField;
/* @var $object SimpleFormDateField */
?>
<div class='form-row form-group <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>
    <input id='<?php echo $object->getId();?>' class='form-control date_picker' type='text' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?> readonly/>
    <!-- 
    <input id='<?php echo $object->getId();?>' data-field="date" class="form-control" name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?> readonly />    
    -->
    <?php if($object->getHasError()) :?>
    <span id="helpBlock2" class="help-block"><?php echo $object->getError();?></span>
    <?php endif;?>
</div>
