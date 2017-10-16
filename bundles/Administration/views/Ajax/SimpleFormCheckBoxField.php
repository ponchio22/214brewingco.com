<?php
use Administration\Data\Template\SimpleFormCheckBoxField;
/* @var $object SimpleFormCheckBoxField */
?>
<div class='checkbox<?php echo " " . $object->getCssclass();?><?php echo ($object->getHasError())?' has-error':''?>' style="<?php echo ($object->getVisible())? "":"display:none;"?>">
    <label><input class="<?php if($object->getSubmitOnChange()){ echo 'checkboxSubmit"';}?>" type='checkbox' id='<?php echo $object->getId();?>' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' <?php echo ($object->getEnabled())? '':'disabled';?> <?php echo ($object->getChecked())? 'checked':'';?>/><?php echo $object->getLabel();?></label>    
    <?php if($object->getHasError()) :?>
    <span id="helpBlock2" class="help-block"><?php echo $object->getError();?></span>
    <?php endif;?>
</div>