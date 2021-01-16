<?php

use Sapiti\SapitiClient;
use Stash\Driver\FileSystem;
use Stash\Pool;

ini_set('log_errors', 0);

require_once 'vendor/autoload.php';

/** Replace with the provided keys */
$publicKey='XXXXXX';
$privateKey='XXXXXX';

/*Create the Sapiti API Client in test mode */
$client = new SapitiClient($publicKey,$privateKey, SapitiClient::MODE_TEST);
$client->setLanguage('en'); //supports fr, nl, de, en

/* Optional : Define you own  PSR-6 caching system : https://www.php-fig.org/psr/psr-6/*/
//$driver = new FileSystem(array());
//$pool = new Pool($driver);
//$client->setCachePool($pool);

/*Test the connection to the server */
echo '\''.$client->System()->ping().'\' from our '. $client->getLastApiResponse()->getEnvironment()." environment\n";

/*Ouput your authentication label */
echo 'Welcome to '.$client->System()->authenticate()->getLabel()."\n";


include 'examples/agenda.php';
include 'examples/timeslots.php';
include 'examples/stock.php';
include 'examples/order.php';
include 'examples/contact.php';
//include 'examples/streams.php';
//include 'examples/orderProcess.php';

