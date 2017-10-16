<?php

use Administration\Data\Template\AdminWebPageHeader;

/* @var $object AdminWebPageHeader */
/* @var $simplePageHeader AdminWebPageHeader */
if(isset($simplePageHeader)) $simplePageHeader = $object;
if(isset($object)) : ?>
<div class="page-header">
    <h1><?php echo $object->getTitle(); ?><?php if($object->getSubtitle()!=""):?><small> (<?php echo $object->getSubtitle();?>)</small><?php endif; ?></h1>
</div>
<?php else: ?>
<div class="alert alert-warning" role="alert">Para utilizar el template <strong>SimplePageHeader.php</strong> necesitas pasar como parametro un objeto <strong>Administration\Data\Template\SimplePageHeader</strong> en la variable <strong>$simplePageHeader</strong></div>
<?php endif; ?>