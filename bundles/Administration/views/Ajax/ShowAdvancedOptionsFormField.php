<?php

use Administration\Controls\ShowAdvancedOptionsFormField;

/* @var $object ShowAdvancedOptionsFormField */
?>
<div class="form-row form-group">
    <a data-toggle="collapse" class="showAdvancedOptionsFormField" href="#<?php echo $object->getCollapseId();?>" aria-expanded="false" aria-controls="advancedOptions"><span class="glyphicon glyphicon-triangle-bottom"></span> <?php echo $object->getLabel();?></a>
</div>