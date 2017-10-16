<?php 
if(isset($messages) || isset($message) || isset($errors)) {
    $messages = (isset($message))? array($message):(isset($messages))? $messages:array();
    $messages = (isset($errors))? $errors:$messages;
    ?><div class='alert alert-danger'><strong>Se encontraron errores!</strong><ul><?php
    foreach($messages as $message) {
        ?><li><?php echo $message; ?></li><?php
    }
    ?></ul></div><?php
}
