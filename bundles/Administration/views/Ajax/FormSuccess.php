<?php 
if(isset($messages) || isset($message)) {
    $messages = (isset($message))? array($message):$messages;
    ?><div class='alert alert-success'><ul><?php
    foreach($messages as $message) {
        ?><li><?php echo $message; ?></li><?php
    }
    ?></ul></div><?php
}
