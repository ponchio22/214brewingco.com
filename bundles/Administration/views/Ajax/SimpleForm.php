<?php
use Administration\Data\Template\SimpleForm;
use Administration\Data\Template\SimpleFormField;

/* @var $object SimpleForm */
if(isset($simpleForm)) {
    $object = $simpleForm;
}
if(isset($object)):
    $formName = $object->getName();
    $action = $object->getAction();
?>
<form id='<?php echo $formName;?>' name='<?php echo $formName;?>' role='form' method='POST' action='<?php echo $action;?>' style="<?php echo ($object->getVisible())?"":"display:none";?>">
    <?php
    $fields = $object->getFields();        
    /* @var $field SimpleFormField */
    foreach($fields as $field){
        if(!$field->getCollapsable())
        $object->embedObject($field);
    }
    ?>
    <div class="collapse" id="<?php echo $object->getCollapseId();?>">
    <?php
    $fields = $object->getFields();        
    /* @var $field SimpleFormField */
    foreach($fields as $field){     
        if($field->getCollapsable())
        $object->embedObject($field);
    }
    ?>
    </div>
    <button id="<?php echo $object->getGuardarButton()->getId();?>" type="submit" name="<?php echo $object->getName();?>[<?php echo $object->getGuardarButton()->getName();?>]" class="btn btn-primary <?php echo ($object->getGuardarButton()->getVisible())?'':'hidden';?>"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>
    <button type="submit" class="btn actualizarButton hidden">Actualizar</button>
    <button id="<?php echo $object->getReturnButton()->getId();?>" type="submit" name="<?php echo $object->getName();?>[<?php echo $object->getReturnButton()->getName();?>]" class="btn btn-default <?php echo ($object->getReturnButton()->getVisible())?'':'hidden';?>"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</button>
</form>
<?php else: ?>
<div class="alert alert-warning" role="alert">Para utilizar el template <strong>SimpleForm.php</strong> necesitas pasar como parametro un objeto <strong>Administration\Data\Template\SimpleForm</strong> en la variable <strong>$simpleForm</strong></div>
<?php endif;?>