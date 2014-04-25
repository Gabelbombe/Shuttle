<?php header('Content-Type: text/plain');
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(dirname(__DIR__)));
define('ENV_FILE', APP_PATH . '/src/config/' . (getenv('APP_ENV') ?: 'local'));

require APP_PATH . '/src/Helpers/LazyLoader.php';
require APP_PATH . '/vendor/autoload.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');
//$lazyLoader->registerGenericNamespace('Solr');

$config = (object) $lazyLoader->config(0);

/**
 * Test Query
 */
$client = New Solarium\Client($config->Solr);
$query  = $client->createSelect();

          $query->setQuery('*:*')
                ->setStart(2)
                ->setRows(1);

$response = $client->execute($query)->getData() ['response']['docs']; // call expansion v5.4+

/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

header('Content-Type: text/html');

/*
 * modify response for insert
 */
$response[0] = ([
        'id'            => 'Opportunity_Test',
        'OpportunityId' => 'Opportunity_Test',
        'text' => [
            strtoupper('Lorem Ipsum'),
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel risus quam. In sed augue tristique, consectetur purus sed, sagittis leo. ',

        ],
        'Title'         => strtoupper('Lorem Ipsum')
    ] + $response[0]
);

print_r($response);

$update = $client->createUpdate();
$insert  = [];

foreach ($response AS $docId => $array)
{
    $insert[$docId] = $update->createDocument();
    foreach($array AS $name => $part)
    {
        if('_version_' !== $name) $insert[$docId]->$name = $part;
    }
}

print_r($insert);

$update->addDocuments($insert)
       ->addCommit();

// this executes the query and returns the result
$result = $client->update($update);

echo "Query status: {$result->getStatus()}";
echo "Query time:   {$result->getQueryTime()}";
die;