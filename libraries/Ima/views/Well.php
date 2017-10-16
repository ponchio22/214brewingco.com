<?php
use Ima\UI\Well;
/* @var $object Well */
?><div class="well" <?php $object->outputAttributesString();?> style="<?php echo ($object->getVisible())?"":"display:none;"?>"><?php echo $object->getText();?></div>
