<?php header('Content-Type: text/plain');
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(dirname(__DIR__)));
define('ENV_FILE', APP_PATH . '/src/config/' . (getenv('APP_ENV') ?: 'local'));

require APP_PATH . '/src/Helpers/LazyLoader.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');

$config = (object) $lazyLoader->config(0);

$solr = New SolrClient([
    'hostname' => $config->Solr->hostname,
    'wt'       => $config->Solr->response,
    'port'     => $config->Solr->port,
    'path'     => $config->Solr->path,
]);

$query = New SolrQuery('*');

print_r($solr->query($query->setStart(0)->setRows(50)->addField('*')));