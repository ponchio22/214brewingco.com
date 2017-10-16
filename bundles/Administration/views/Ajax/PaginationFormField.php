<?php

use Administration\Controls\PaginationFormField;
use Ima\Routing\Routing;
/* @var $object PaginationFormField */
$limit = $object->getLimit();
$total = $object->getTotal();
$offset = $object->getOffset();
$pages = ($limit != null)? ceil($total/$limit):0;
if($total > 0):
$currentPage = floor(($offset/$total) * $pages);
$extraParameters = $object->getExtraParameters();
?>
<div id="<?php echo $object->getId();?>" data-current-path="<?php echo Routing::getFullCurrentPath();?>" data-limit="<?php echo $limit;?>" data-total="<?php echo $total;?>" data-offset="<?php echo $offset;?>" data-follow-links="<?php echo $object->getFollowLinks();?>" class="pagination-container text-center" style="<?php echo (($pages > 1) && $object->getVisible())?"":"display:none;"?>">    
    <div><?php echo "<strong>" . ($offset+1) . "-" . (($offset+$limit > $total)? $total:$offset+$limit) . "</strong> de <strong>" . $total . "</strong>";?></strong></div>
    <ul class="pagination">
      <!--li>
        <a data-offset="<?php echo $offset-$limit;?>" href="?<?php echo http_build_query(array_merge(["limit"=>$limit,"offset"=>($offset-$limit)],$extraParameters));?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li-->   
      <li class="samplePage" style="display:none;"><a data-offset="" href=""></a></li>
      <?php 
      for($i=0;$i<$pages;$i++):
          $parameters = array_merge(["limit"=>$limit,"offset"=>($limit*$i)],$extraParameters);
      ?>
      <li class="<?php echo ($i==$currentPage)? "active":"";?>"><a data-offset="<?php echo $parameters["offset"];?>" href="?<?php echo http_build_query($parameters);?>"><?php echo $i+1;?></a></li>
      <?php endfor;?>
      <!--li>
        <a data-offset="<?php echo $offset+$limit;?>" href="?<?php echo http_build_query(array_merge(["limit"=>$limit,"offset"=>($offset+$limit)],$extraParameters));?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li-->
    </ul>
</div>
<?php
endif;
?>