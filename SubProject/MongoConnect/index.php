<?php header('Content-Type: text/plain');
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(dirname(__DIR__)));
define('ENV_FILE', APP_PATH . '/src/config/' . (getenv('APP_ENV') ?: 'local'));

require APP_PATH . '/src/Helpers/LazyLoader.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');

/**
$payload = [
    'type' => (! isset($argv) ?: 0),
    'args' => (! isset($argv) ? $_GET : $argv),
];

$bootstrap = New \Helpers\Bootstrap($payload);
$bootstrap->run();
*/


$config = (object) $lazyLoader->config(0);
//Test: $config = $lazyLoader->config(APP_PATH . '/src/config/generic');

print_r($config->Mongo);