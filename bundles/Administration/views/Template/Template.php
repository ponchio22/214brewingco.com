<?php

use Administration\Data\AdministrationNavBar;
use Administration\Data\Template\AdministrationTemplate;
use Ima\MySql\MySqlLog;
use Ima\Routing\Routing;
use Ima\Users\AuthenticationManagment;
use Ima\Users\UserMysql;

$myaccountSections = array('myaccount_home','myaccount_save','myaccount_passwordchange','myaccount_passwordchange_save');
$am = AuthenticationManagment::getInstance();
/* @var $user UserMysql */
$user = $am->getCurrentSessionUser();
$username = ($user!=NULL)? $user->username:'';
/* @var $this AdministrationTemplate */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo.ico">
    <title>214 Brewing Co - <?php $this->setBlock(AdministrationTemplate::TITLE);?></title>
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_114x114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_144x144.png" />

    <link href="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/css/bootstrap.min.css" rel="stylesheet">    
    <link href="<?php echo Routing::getRoot(true);?>/resources/Administration/css/administration.css" rel="stylesheet">    
    <link rel="stylesheet" href="<?php echo Routing::getRoot(true)?>/resources/Bootstrap/css/datepicker.css"/>
    <link rel="stylesheet" href="<?php echo Routing::getRoot(true)?>/resources/Bootstrap/css/DateTimePicker.css"/>
    <link rel="stylesheet" href="<?php echo Routing::getRoot(true)?>/resources/font-awesome-4.6.3/css/font-awesome.min.css"/>
    <?php $this->setBlock(AdministrationTemplate::STYLE_SHEETS);?>
    <link href="<?php echo Routing::getRoot(true);?>/resources/Project/css/CustomIcons.css" rel="stylesheet">    
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php
    (new AdministrationNavBar())->output();
    ?>
    <!-- Container -->
    <div class="container">
        <?php $this->setBlock(AdministrationTemplate::PAGE_HEADER);?>
        <?php $this->setBlock(AdministrationTemplate::MENU);?>
        <div id='informationContainer'>            
            <?php $this->setBlock(AdministrationTemplate::MESSAGES);?>
        </div>
        <?php $this->setBlock(AdministrationTemplate::CONTENT);?>
        <br>
    </div>
    <?php
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
    <!-- Javascripts -->
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo Routing::getRoot(true);?>/resources/jQuery/js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/bootstrap.min.js"></script>
    <script type=text/javascript src="<?php echo Routing::getRoot(true)?>/resources/Bootstrap/js/DateTimePicker.js"></script>
    <script type=text/javascript src="<?php echo Routing::getRoot(true)?>/resources/Bootstrap/js/bootstrap-datepicker.js"></script>
    <script type=text/javascript src="<?php echo Routing::getRoot(true)?>/resources/Administration/js/modernizr-custom.js"></script>    
    <script type=text/javascript src="<?php echo Routing::getRoot(true)?>/resources/Administration/js/SimpleForm.js"></script>    
    <?php $this->setBlock(AdministrationTemplate::JAVASCRIPTS);?>
    <?php
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