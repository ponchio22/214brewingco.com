<?php
use Administration\Data\Template\SimpleFormSelectField;
use Administration\Data\Template\SimpleFormSelectFieldOption;
/* @var $object SimpleFormSelectField */
?>
<div class='form-row form-group <?php echo ($object->getVisible())? "":"hidden"; ?> <?php echo ($object->getHasError())?'has-error':''?>'>
    <label for='<?php echo $object->getId();?>'><?php echo $object->getLabel();?></label>
    <div class='input-group'>        
        <select id='<?php echo $object->getId();?>' name='<?php echo $object->findForm()->getName();?>[<?php echo $object->getId();?>][]' class='form-control' multiple='multiple' <?php echo ($object->getEnabled())? '':'disabled';?>>
            <?php 
            $options = $object->getOptions();
            /* @var $option SimpleFormSelectFieldOption */
            foreach($options as $option) : 
            ?>
            <option value="<?php echo $option->getValue();?>" <?php echo ($object->valueMatches($option->getValue()))? 'selected':'';?>><?php echo $option->getText();?></option>
            <?php endforeach;?>
        </select>
        <span class="input-group-btn">
            <button name='<?php echo $object->getAddButtonName(); ?>' value='agregar' class="btn btn-default" type="submit">Agregar</button>
        </span>
    </div>
    <?php if($object->getHasError()) :?>
    <span id="helpBlock2" class="help-block"><?php echo $object->getError();?></span>
    <?php endif;?>
</div>