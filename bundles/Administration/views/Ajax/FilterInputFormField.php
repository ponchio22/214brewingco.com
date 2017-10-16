<?php

use Administration\Controls\FilterInputFormField;

/* @var $object FilterInputFormField */
?>
<div class='form-row form-group <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <div class="input-group">
        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
        <input id='<?php echo $object->getId();?>' auto-submit='<?php echo ($object->getAutoSubmit())? "1":"0";?>' data-bind='<?php echo $object->getAjaxPath();?>' class='filterInputFormField autocompleteFormField form-control <?php echo " ".$object->getCssclass();?>' type='text' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' placeholder="<?php echo $object->getPlaceHolder();?>" value='<?php echo $object->getValue();?>' <?php echo ($object->getEnabled())? '':'disabled';?> autocomplete="off"/>
        <span class="input-group-btn">            
            <button value='limpiar' class="btn btn-default filter_clear_button" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
        </span>
    </div>
    <span id="helpBlock2" class="help-block" style='<?php echo ($object->getHasError())? "":"display:none;";?>'><?php echo $object->getError();?></span>    
</div>