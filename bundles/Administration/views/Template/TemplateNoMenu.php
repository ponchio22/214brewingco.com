<?php
use Ima\Routing\Routing;
use Administration\Data\NavigationHelper;
use Ima\Template\Template;

/* @var $this Template */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>214 Brewing Co - <?php $this->setBlock('title');?></title>
    <link href="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Routing::getRoot(true);?>/resources/Administration/css/administration.css" rel="stylesheet">
    <?php $this->setBlock('stylesheets');?>
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id='top'>
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>            
            <a class="navbar-brand" rel="home" href="#" title="El Antojito Francés">
                <img style="max-width:100px; margin-top: -11px;" src="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo.png">
            </a>
            <a class="navbar-brand" rel="home" href="#" title="El Antojito Francés">El Antojito Francés</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo Routing::getPath('admin_home');?>">Administrar</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <!-- Container -->
    <div class="container">
        <?php $this->setBlock('pageheader');?>
        <div id='informationContainer'>            
            <?php $this->setBlock('messages');?>
        </div>
        <?php $this->setBlock('content');?>
    </div>

    <!-- Javascripts -->
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/bootstrap.min.js"></script>
    <?php $this->setBlock('javascripts');?>
  </body>
</html>