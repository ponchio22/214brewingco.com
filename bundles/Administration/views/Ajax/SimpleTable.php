<?php
 
use Administration\Data\Template\SimpleTable;
 use Administration\Data\Template\SimpleTableColumn;
 
/* @var $simpleTable SimpleTable */
/* @var $column SimpleTableColumn */
if(isset($simpleTable)) :
    $items = (!isset($items))? $simpleTable->getItems():$items;
    $columns = (!isset($columns))? $simpleTable->getColumns():$columns;    
    if(count($columns)>0) :?>
    <table class='table table-striped'>
        <thead>
            <?php foreach($columns as $column) :?><th><?php echo $column->getText();?></th><?php endforeach;?>
        </thead>
        <?php foreach($items as $item): ?>
        <tr>
            <?php
            foreach($columns as $column) : 
            $columnName = $column->getName();
            ?>
            <td><?php
            if(property_exists($item, $columnName)) {
                echo $item->$columnName;
            } else if(method_exists($item, $columnName)) {
                echo $item->$columnName();
            } else if(key_exists($item, $columnName)) {
                echo $item[$columnName];
            }
            ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach;?>
    </table>
    <?php endif;?>
<?php else: ?>
<div class="alert alert-warning" role="alert">Para utilizar el template <strong>SimpleTable.php</strong> necesitas pasar como parametro un objeto <strong>Administration\Data\Template\SimpleTable</strong> en la variable <strong>$simpleTable</strong></div>
<?php endif;?>