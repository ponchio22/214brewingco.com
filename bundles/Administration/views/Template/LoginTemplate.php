<?php
use Ima\Routing\Routing;
use Ima\Template\Template;
$urlParts = parse_url(Routing::getCurrentPath());
if(array_key_exists('query', $urlParts)){
    $url = '?'.$urlParts['query'];
} else {
    $url = '';
}
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
    <link rel="icon" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo.ico">
    <title>214 Brewing Co - <?php $this->setBlock('title');?></title>
    <link href="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Routing::getRoot(true);?>/resources/Administration/css/login.css" rel="stylesheet">
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

    <div class="container">

        <form class="form-signin" name='acceso' role="form" method="POST" action='<?php echo Routing::getPath('authentication_dologin').$url;?>'>
            <div class="text-center"><img src='<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo-big.png'/></div>
            <h2 class="form-signin-heading">214 Brewing Co</h2>
            <h4 class="form-signin-heading">Administración</h4>            
            <?php $this->setBlock('messages');?>
            <label for="acceso_username" class="sr-only">Usuario</label>
            <input id="acceso_username" name='acceso[username]' class="form-control" placeholder="Usuario" autofocus>
            <label for="acceso_password" class="sr-only">Contraseña</label>
            <input type="password" id="acceso_password" name='acceso[password]' class="form-control" placeholder="Contraseña">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Accesar</button>
        </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
