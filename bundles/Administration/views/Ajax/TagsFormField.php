<?php

use Administration\Controls\TagsFormField;

/* @var $object TagsFormField */
?>
<div class="form-row tagsFormField breadcrumb" id="<?php echo $object->getId();?>" style="<?php echo ($object->getVisible())? "":"display:none";?>">    
    <label><?php echo $object->getLabel();?> </label>
    <span id="<?php echo $object->getId();?>_tag_sample" class="label label-default" style="display:none;"><span class="tag_label">Ejemplo</span> <a style="color:white" href="#"><span class="glyphicon glyphicon-remove"></span></a></span>
    <?php 
    $tags = $object->getTags();
    if(count($tags)>0):
    foreach($tags as $tag):
    ?><span id="" class="label label-default tagsFormFieldItem"><span class="tag_label"><?php echo $tag?></span> <a style="color:white" href="#"><span class="glyphicon glyphicon-remove"></span></a></span><?php
    endforeach;
    endif;
    ?>
</div>
