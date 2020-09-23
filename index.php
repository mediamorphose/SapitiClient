<?php


use Sapiti\SapitiClient;

ini_set('log_errors', 0);

require_once 'vendor/autoload.php';

/** Replace with the provided keys */
$publicKey='XXXXXX';
$privateKey='XXXXXX';

/*Create the Sapiti API Client in test mode */
$client = new SapitiClient($publicKey,$privateKey, SapitiClient::MODE_TEST);

/*Test the connection to the server */
echo '\''.$client->System()->ping().'\' from our '. $client->getLastApiResponse()->getEnvironment()." environment\n";

/*Ouput your authentication label */
echo 'Welcome to '.$client->System()->authenticate()->getLabel()."\n";

include 'examples/agenda.php';
include 'examples/contact.php';