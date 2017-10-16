<?php

use Ima\Template\Template;

$t = new Template('bundles/Administration/views/Template/Template.php');

$t->block('title');
?>Administración<?php
$t->endBlock();

$t->block('headerTitle');
?>Administración<?php
$t->endBlock();

$t->block('menu');
$t->embed('bundles/Administration/views/Ajax/menu.php');
$t->endBlock();

$t->send();