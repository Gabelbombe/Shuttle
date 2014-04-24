<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(__DIR__));
define('ENV_FILE', APP_PATH . '/config/' . (getenv('APP_ENV') ?: 'local') . '.json');

require APP_PATH . '/src/Helpers/LazyLoader.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');

$payload =
    [
        'type' => (! isset($argv) ?: 0),
        'args' => (! isset($argv) ? $_GET : $argv),
    ];

$bootstrap = New \Helpers\Bootstrap($payload);
$bootstrap->run();