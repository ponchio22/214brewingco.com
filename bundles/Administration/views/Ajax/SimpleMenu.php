<?php
use Administration\Data\Template\SimpleMenu;
use Administration\Data\Template\SimpleMenuItem;
use Ima\Routing\Routing;

/* @var $object SimpleMenu */
/* @var $simpleMenu SimpleMenu */
if(isset($simpleMenu)) $object = $simpleMenu;

if(isset($object)) :
$currentRouteName = Routing::getRouteName();
?>
<ul class="nav nav-pills">
    <?php 
    /* @var $item SimpleMenuItem */
    foreach($object->getItems() as $item):
        $found = false;
        foreach($item->getRouteNames() as $routeName) {
        $found = ($currentRouteName==$routeName)? true:$found;
        }
        if(!$item->getVisibleOnlyWhenUsed() || ($item->getVisibleOnlyWhenUsed() && $found)) :
        ?><li role="presentation" class='<?php echo ($found)? 'active':'';?>'><a href="<?php echo ($item->getVisibleOnlyWhenUsed())? '#':Routing::getPath($item->getRouteNames()[0]);?>"><?php echo $item->getText(); ?></a></li><?php 
        endif;
    endforeach; 
    ?>
</ul>
<p></p>
<?php else: ?>
<div class="alert alert-warning" role="alert">Para utilizar el template <strong>SimpleMenu.php</strong> necesitas pasar como parametro un objeto <strong>Administration\Data\Template\SimpleMenu</strong> en la variable <strong>$simpleMenu</strong></div>
<?php endif; ?>