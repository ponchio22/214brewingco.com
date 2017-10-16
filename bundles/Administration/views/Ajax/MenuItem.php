<?php

use Administration\Data\Template\MenuItem;
use Ima\Routing\Routing;

/* @var $object MenuItem */
if($object->getVisible()):
?>
<li id="<?php echo $object->getId();?>" role="presentation" <?php echo ($object->getShowSpinner())? "data-spinner='1'":"0";?> class='MenuItem <?php echo ($object->getSelected())? 'active':'';?>'><a href="<?php echo $object->getLink();?>"><?php echo $object->getText(); ?></a></li>
<?php
endif;
?>