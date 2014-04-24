<?php

error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(__DIR__));
require APP_PATH . '/vendor/autoload.php';

$bootstrap = New \Helpers\Bootstrap($payload);
$bootstrap->run();