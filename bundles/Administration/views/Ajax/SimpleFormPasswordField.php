<?php
use Administration\Data\Template\SimpleFormPasswordField;
/* @var $object SimpleFormPasswordField */
?>
<div class='form-row form-group <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>        
    <input id='<?php echo $object->getId();?>' class='form-control' type='password' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?>/>
    <?php if($object->getHasError()) :?>
    <span id="helpBlock2" class="help-block"><?php echo $object->getError();?></span>
    <?php endif;?>
</div>