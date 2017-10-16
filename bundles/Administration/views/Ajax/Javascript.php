<?php

use Ima\Routing\Routing;
use Ima\UI\Javascript;

/* @var $object Javascript */
?>  <script type=text/javascript src="<?php echo Routing::getRoot(true)?>/<?php echo $object->getPath();?>"></script>
    