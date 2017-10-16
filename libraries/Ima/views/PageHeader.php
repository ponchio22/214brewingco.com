<?php

use Administration\Data\ProjectData;
use Administration\Data\Template\AdministrationTemplate;
use Ima\Routing\Routing;
use Ima\UI\PageHeader;

/* @var $object PageHeader */
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="<?php echo Routing::getRoot(true);?>/resources/Administration/images/logo.ico">
<title><?php echo $object->getTitle();?></title>
<?php $this->setBlock(AdministrationTemplate::STYLE_SHEETS);?>

<script src="<?php echo Routing::getRoot(true);?>/resources/Bootstrap/js/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
