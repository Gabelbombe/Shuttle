<?php
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(__DIR__));
define('ENV_FILE', APP_PATH . '/config/' . (getenv('APP_ENV') ?: 'local') . '.json');

require APP_PATH . '/src/Helpers/LazyLoader.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');

$config = array(
    'endpoint' => array(
        'localhost' => array(
            'host' => '127.0.0.1', 'port' => '8983', 'path' => '/solr/'
        )
    )
);

// new Solarium Client object
$client = New Solarium\Client($config);

print_r($client);


/*
$payload =
    [
        'type' => (! isset($argv) ?: 0),
        'args' => (! isset($argv) ? $_GET : $argv),
    ];

$bootstrap = New \Helpers\Bootstrap($payload);
$bootstrap->run();
*/