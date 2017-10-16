<?php

use Administration\Controls\DeleteButton;
/* @var $object DeleteButton */
?>
<button type="submit" data-toggle="modal" data-target="#<?php echo $object->getId()."_modal";?>" name="<?php echo $object->findForm()->getName();?>[<?php echo $object->getName();?>]" class="btn <?php echo ($object->getPrimary())? ' btn-primary':'btn-default';?><?php echo ($object->getVisible())?'':' hidden';?><?php echo " ".$object->getCssclass(); ?>"><?php echo $object->getLabel();?></button>
<div id="<?php echo $object->getId()."_modal";?>_test" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <!--div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div-->
        <div class="modal-body">
            <p><?php echo $object->getModalMessage();?></p>
        </div>
        <div class="modal-footer">            
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button name="<?php echo $object->findForm()->getName();?>[<?php echo $object->getName();?>]" type="button" class="btn btn-primary imsure_button">Estoy Seguro</button>
        </div>
    </div>
</div>