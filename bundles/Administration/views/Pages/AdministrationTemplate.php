<?php

use Administration\Data\AdministrationTemplate;
use Administration\Data\NavigationHelper;
use Administration\Data\ProjectData;
use Authentication\Controller\Authentication;
use ControlInventarios\Controller\CategoriaProductoController;
use Finanzas\Controller\ClienteController;
use Finanzas\Controller\EgresoController;
use Finanzas\Controller\PagoController;
use Finanzas\Controller\PedidoController;
use Finanzas\Controller\VentaController;
use Ima\MySql\MySqlLog;
use Ima\Routing\Routing;
use UserAdmin\Controller\UserAdmin;

/* @var $object AdministrationTemplate */
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
    <title><?php echo (new ProjectData())->getCompanyName() . " - " . $object->getTitle();?></title>
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_114x114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo_144x144.png" />

    <?php $this->setBlock(AdministrationTemplate::STYLE_SHEETS);?>
    
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
            <a class="navbar-brand" rel="home" href="#" title="214 Brewing Company">
                <img style="max-width:100px; margin-top: -11px;" src="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo.png">
            </a>
            <a class="navbar-brand" href="#">214 Brewing Co</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class='<?php echo NavigationHelper::getMenuActive('admin_home');?>'><a href="<?php echo Routing::getPath('admin_home');?>">Inicio</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Finanzas <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo Routing::getPath(ClienteController::CONSULTAR_ROUTE);?>">Clientes</a></li>
                        <li><a href="<?php echo Routing::getPath(PedidoController::CONSULTAR_ROUTE);?>">Pedidos</a></li>
                        <li><a href="<?php echo Routing::getPath(VentaController::CONSULTAR_ROUTE);?>">Ventas</a></li>
                        <li><a href="<?php echo Routing::getPath(PagoController::NUEVO_PAGO);?>">Pagos</a></li>                        
                        <li><a href="<?php echo Routing::getPath('facturacion_admin_home');?>">Facturación</a></li>
                        <li><a href="<?php echo Routing::getPath(EgresoController::CONSULTAR_ROUTE);?>">Compras</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catálogo <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo Routing::getPath('clientes_consultar');?>">Clientes</a></li>
                        <li><a href="<?php echo Routing::getPath(CategoriaProductoController::LIST_ROUTE);?>">Categorías de Productos</a></li>
                        <li><a href="<?php echo Routing::getPath('productos_consultar');?>">Productos</a></li>
                        <li><a href="<?php echo Routing::getPath('proveedores_consultar');?>">Proveedores</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sistema <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo Routing::getPath(UserAdmin::CONSULTAR_ROUTE);?>">Usuarios</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class='<?php echo NavigationHelper::getMenuActive($myaccountSections);?>'><a href="<?php echo Routing::getPath('myaccount_home');?>"><span class="glyphicon glyphicon-user"></span> Mi Cuenta (<?php echo $username;?>)</a></li>
                <li><a href="<?php echo Authentication::getRedirectToLogoutPath();?>">Cerrar sesión</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
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