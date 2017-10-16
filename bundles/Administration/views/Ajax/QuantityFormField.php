<?php

use Administration\Controls\QuantityFormField;

/* @var $object QuantityFormField */
ob_start();
?><input id='<?php echo $object->getId();?>' class='form-control quantity_field <?php echo $object->getCssclass();?>' novalidate="novalidate" type="number" step="1" name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getName();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?> style="<?php echo ($object->getOutputOnlyInput() && !$object->getVisible())? "display:none":"";?>"/><?php
$input = ob_get_contents();
ob_clean();
if($object->getOutputOnlyInput()):
    echo $input;
else:
?>
<div class='form-row form-group quantity_field_container <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>      
    <?php echo $input;?>
    <span id="helpBlock2" class="help-block" style='<?php echo ($object->getHasError())? "":"display:none;";?>'><?php echo $object->getError();?></span>
</div>
<?php 
endif;
?>