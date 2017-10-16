<?php
$GLOBALS["execution_time"] = microtime(true); 
use Ima\Routing\Routing;
include __DIR__ . "/libraries/autoload.php";
new Routing();
