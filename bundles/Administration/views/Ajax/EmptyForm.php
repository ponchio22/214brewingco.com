<?php

use Administration\Data\Template\EmptyForm;
use Ima\UI\FormField;

/* @var $object EmptyForm */
?>
<form id='<?php echo $object->getName();?>' <?php foreach($object->getAttributes() as $attr) { echo key($attr)."='".$attr[key($attr)]."'"; } ?> class='<?php echo $object->getCssclass();?>' name='<?php echo $object->getName();?>' role='form' method='POST' action='<?php echo $object->getAction();?>' style="<?php echo ($object->getVisible())?"":"display:none;";?>">
    <?php
    $fields = $object->getItems();
    foreach($fields as $field) {
        $object->embedObject($field);
    }
    ?>    
</form>