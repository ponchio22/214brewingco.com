<?php

use Administration\Controls\TotalQuantityInformativeFormField;
use Ima\Data\NumberFormat;
/* @var $object TotalQuantityInformativeFormField */
?>
<div id="<?php echo $object->getId();?>" class="form-row form-group panel panel-default total_quantity_informative_form_field <?php echo $object->getCssclass();?>" style="<?php echo ($object->getVisible())? "":"display:none;";?>">
    <div class="panel-body"><h4><span class="total_label"><?php echo $object->getLabel();?>:</span> <span class="text-primary">$<?php echo NumberFormat::money($object->getTotal(),true);?></span></h4></div>
</div>