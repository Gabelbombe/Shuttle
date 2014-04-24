<?php header('Content-Type: text/plain');
error_reporting(-1);
ini_set('display_errors', 1);

define('APP_PATH', dirname(dirname(__DIR__)));
define('ENV_FILE', APP_PATH . '/src/config/' . (getenv('APP_ENV') ?: 'local'));

require APP_PATH . '/src/Helpers/LazyLoader.php';

$lazyLoader = New \Helpers\LazyLoader(APP_PATH . '/src/');
$lazyLoader->registerGenericNamespace('Helpers');

$config = (object) $lazyLoader->config(0);

/**
 * -vvv
 *
 * \MongoLog::setLevel(\MongoLog::ALL);    // all log levels
 * \MongoLog::setModule(\MongoLog::ALL);   // all parts of the driver
 */

$mongo = New MongoClient($config->Mongo->server);
$mdb   = $mongo->{$config->Mongo->database};

foreach ($mdb->getCollectionNames() AS $collection)
{
    echo $collection;
}

/*

$this->m = new MongoClient('mongodb://' . $this->params['benApiMongo']);
$this->db = $this->m->BenAPI;
$this->collection = $this->db->Account;
$document = array('AccountFlags' => array(
    "MustChangePassword" => false,
    "HasAcceptedWebsiteTerms" => true,
    "HasClosedCookieLink" => false,
),
    "AccountId" => "CON99999999",
    "Email" => "qatest@qatest.com",
    "FirstName" => "QA",
    "LastName" => "TEST",
    "MI" => null,
    "Role" => "4",
    "Salt" => "22B",
    "Status" => null,
    "Title" => "Brand Integration",
    "Username" => "default99999999",
    "_id" => new MongoId('534d91bf087aa99c21b74abd'),
);
$this->collection->insert($document);
*/