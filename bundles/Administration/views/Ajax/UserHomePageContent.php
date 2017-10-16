<?php

use Administration\Controls\UserHomePageContent;
use Finanzas\Data\PedidoManagment;

/* @var $object UserHomePageContent */
$pedidos = (new PedidoManagment())->all(true);
$object->getResult()->output();
$object->getAgregarPagoForm()->output();
?>
<h3>Pedidos</h3>
<?php
$object->getPedidosForm()->output();
?>
<h3>Pagos</h3>
<?php
$object->getPagosForm()->output();
?>