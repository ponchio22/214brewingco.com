<?php 
use Administration\Data\Template\AdminWebPageFormResult;

/* @var $object AdminWebPageFormResult */
    $success = $object->getSuccess();
    $messages = $object->getMessages();
?>
<div id='informationContainer' class="informationContainer" style="<?php echo ($object->getVisible())? "":"display:none;";?>">
    <div class='alert <?php echo $object->getAlertClass();?>'>
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="message">
        <?php 
        if($success):    
            $multipleMessages = (count($messages)>1);
            if($multipleMessages):?><ul><?php endif;
            foreach($messages as $message):
                if($multipleMessages):?><li><?php endif;
                ?><?php echo $message;?><?php
                if($multipleMessages):?></li><?php endif;
            endforeach;          
            if($multipleMessages):?></ul><?php endif;
        else:
            if(count($messages) > 0):
            ?><ul><?php 
            foreach($messages as $message):
            ?><li><?php echo $message;?></li><?php    
            endforeach;          
            ?></ul><?php
            else:
            ?><strong><?php echo ($object->getText()!="")?$object->getText():"Se encontraron errores!";?></strong><?php
            endif;            
        endif;
        ?>       
        </span>
    </div>
</div>