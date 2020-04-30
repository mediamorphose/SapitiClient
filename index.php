<?php

use Sapiti\SapitiClient;

require_once 'vendor/autoload.php';

$client = new SapitiClient('test','test');
$client->setTestMode(true);
echo $client->System()->ping();
//echo $client->getLastApiResponse()->getEnvironment()."\n";
//echo $client->getLastApiResponse()->getDateTime()->format('Y-m-d H:i:s')."\n";
//var_dump($client->System()->pingParams([1=>"youpi","prout"=>"hdg jhgj dsgh j"]));