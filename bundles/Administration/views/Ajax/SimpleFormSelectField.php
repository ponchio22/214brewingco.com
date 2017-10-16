<?php

use Administration\Data\Template\SimpleFormSelectField;
use Administration\Data\Template\SimpleFormSelectFieldOption;
/* @var $object SimpleFormSelectField */
?>
<div class='form-row form-group <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>    
    <?php
    if($object->getAddButton()->getVisible()):
    ?>
    <div class="input-group">
    <?php
    endif;
    ?>
        <select class="form-control simpleFormSelectField<?php echo ($object->getSubmitOnChange())? " simpleFormSelectFieldSubmitOnChange":""; ?> <?php echo $object->getCssclass();?>" id='<?php echo $object->getId();?>' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>]' <?php echo ($object->getEnabled())? '':'disabled';?>>
        <?php 
        $options = $object->getOptions();
        /* @var $option SimpleFormSelectFieldOption */
        if(count($options)>0): 
        foreach($options as $option) : 
        ?>
        <option value="<?php echo $option->getValue();?>" <?php echo ($option->getValue()==$object->getValue())? 'selected':'';?>><?php echo $option->getText();?></option>
        <?php 
        endforeach; 
        endif;
        ?>
        </select>    
    <?php
    if($object->getAddButton()->getVisible()):
    ?>
    <span class="input-group-btn">
        <button name='<?php echo $object->findForm()->getName(); ?>[<?php echo $object->getAddButtonName(); ?>]' value='agregar' class="btn btn-default add" type="submit"><span class="glyphicon glyphicon-plus"></span></button>
    </span>
    </div>
    <?php
    endif;
    ?>        
    <span id="helpBlock2" class="help-block" style='<?php echo ($object->getHasError())? "":"display:none;";?>'><?php echo $object->getError();?></span>    
</div>