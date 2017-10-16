<?php

use Ima\MySql\MySqlLog;
use Ima\Routing\Routing;
use Ima\UI\HtmlRepresentation;
use Ima\UI\Javascript;
use Ima\UI\Stylesheet;
use Ima\UI\WebPage;
use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

/* @var $object WebPage */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $object->getDescription();?>">
        <meta name="author" content="<?php echo $object->getAuthor();?>">
        <meta name="theme-color" content="<?php echo $object->getThemeColor();?>">
        <title><?php echo $object->getTitle();?></title>
        <!-- Minified Stylesheet File -->
        <?php 
        $object->getMinifiedStyleSheet()->output();
        ?>
        <link rel="icon" sizes="32x32" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_32x32.ico" />
        <link rel="icon" sizes="48x48" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/favicon.ico">
        <link rel="icon" sizes="16x16" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/ficon.ico" />
        <link rel="icon" sizes="64x64" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_64x64.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_144x144.png" />        
        <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie-emulation-modes-warning.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php 
        /* @var $item HtmlRepresentation */
        foreach($object->items as $item) {
            $item->output();
        }

        if(isset($_GET["logs"])):
        ?>
        <div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
            <div class="modal-dialog">                    
                <div class="modal-content">
                    <div class="modal-header">                    
                        <h4 class="modal-title" id="memberModalLabel">Mysql Content Log</h4>
                    </div>
                    <div class="modal-body">
                    <?php 
                    $logs = MySqlLog::getLogs();
                    $totalTime = 0;
                    foreach($logs as $log):
                        ?><div><?php echo $log["log"];?> - <?php echo $log["time"];?>ms</div><?php
                        $totalTime += $log["time"];
                    endforeach;
                    ?>
                        <p>Tiempo Total: <?php echo $totalTime;?>ms</p>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        endif;
        ?>
        
    <!-- Minified Javascript File -->
    <?php 
    $object->getMinifiedJavascript()->output();
    if(isset($_GET["logs"])):
    ?>
    <script type="text/javascript">        
    $('#logModal').modal('show');
    </script>
    <?php 
    endif;
?>
    </body>
</html>