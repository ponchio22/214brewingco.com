<?php
use Administration\Data\Template\SimpleFormInputTextField;
/* @var $object SimpleFormInputTextField */
?>
<div class='form-row form-group <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>        
    <input id='<?php echo $object->getId();?>' class='form-control' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?>/>    
    <span id="helpBlock2" class="help-block" style='<?php echo ($object->getHasError())? "":"display:none;";?>'><?php echo $object->getError();?></span>
</div>