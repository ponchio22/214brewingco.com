<?php

use Ima\UI\HtmlRepresentation;
use Ima\UI\WebPageContainer;

/* @var $object WebPageContainer */
?>
<div class="container">
    <?php
    /* @var $item HtmlRepresentation */
    foreach($object->getItems() as $item) {
        if($item != NULL) {
            $item->output();
        }
    }
    ?>
</div>
<br/>