<?php header('Content-Type: text/plain');
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(dirname(__DIR__)));
define('ENV_FILE', APP_PATH . '/src/config/' . (getenv('APP_ENV') ?: 'local'));

require APP_PATH . '/src/Helpers/LazyLoader.php';
require APP_PATH . '/vendor/autoload.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');
$lazyLoader->registerGenericNamespace('Solr');

$config = (object) $lazyLoader->config(0);


$client = New Solarium\Client($config->Solr);


print_r($client);


die;
    $solr = New SolrClient([
        'hostname' => $config->Solr->hostname,
        'wt'       => $config->Solr->response,
        'port'     => $config->Solr->port,
        'path'     => $config->Solr->path,
    ]);

/**
 * Test Query
 */

$query = New SolrQuery('*');             // ->setRows(50)
$response = $solr->query($query->setStart(0)->setRows(1)->addField('*'));

/**
 * See: response.nfo
 *
 * print_r(json_encode($response->getResponse() ['response']['docs']));
 */


/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

header('Content-Type: text/plain');
$records = json_encode($response->getResponse() ['response']['docs'], JSON_PRETTY_PRINT);
$records = json_decode($records, 1);


$solr = New Solr\Client();
$solr->setRecords($records)->assemble();


//print_r($solrInputDocument); die; // broken
die;
/** @var  $updateResponse */

print_r($docs[0]->toArray());
//$updateResponse = $solr->addDocuments($docsArray);
//    print_r($updateResponse->getResponse());
die;


$query    = New SolrQuery('*');
//$response = $solr->query($query->setStart(0)->setRows(1)->addField('id'));

print_r($response);