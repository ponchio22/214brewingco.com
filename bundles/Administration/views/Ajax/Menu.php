<?php

use Administration\Data\Template\Menu;
use Administration\Data\Template\MenuItem;

/* @var $object Menu */
?>
<ul class="Menu nav nav-pills" id="<?php echo $object->getId();?>">
    <?php 
    /* @var $item MenuItem */
    foreach($object->getItems() as $item){
        $object->embedObject($item);
    }
    ?>
</ul>
<p></p>