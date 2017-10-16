<?php

use Administration\Controls\AutocompleteFormField;

/* @var $object AutocompleteFormField */
ob_start();
?><input id='<?php echo $object->getId();?>' indicate-onchange='<?php echo ($object->getOptionExistsIndicator())?"1":"0";?>' data-bind='<?php echo $object->getAjaxPath();?>' class='form-control autocompleteFormField <?php echo $object->getCssclass();?>' name='<?php echo $object->getFieldFormName();?>' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?> autocomplete="off" style="<?php echo ($object->getOutputOnlyInput() && !$object->getVisible())? "display:none":"";?>"/><?php
$input = ob_get_contents();
ob_clean();
if($object->getOutputOnlyInput()):
    echo $input;
else:
?>
<div class="form-row form-group <?php echo ($object->getHasError())?'has-error':''?>" style="<?php echo ($object->getVisible())?"":"display:none"?>">
    <label style="<?php echo ($object->getCompactMode())? "display:none":"";?>"><?php echo $object->getLabel();?></label><?php
    if($object->getCompactMode() || $object->getShowClearAddOn()):
        ?><div class="input-group"><?php    
        if($object->getCompactMode()):
            ?><div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div><?php
        endif;
    endif;
    echo $input;
    if($object->getShowClearAddOn()):
        ?><div class="input-group-btn"><button class="btn btn-default clear_button" type="button" title="Limpiar campo"><span class="glyphicon glyphicon-remove"></span></button></div><?php
    endif;
    if($object->getCompactMode() || $object->getShowClearAddOn()):
    ?></div><?php
    endif;
    ?><span id="helpBlock2" class="help-block" notfound-msg='<?php echo $object->getNotFoundMessage();?>' style='<?php echo ($object->getHasError())? "":"display:none;";?>'><?php echo $object->getError();?></span>
</div>
<?php
endif;
?>