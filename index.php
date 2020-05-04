<?php

use Sapiti\Objects\Agenda\Event;
use Sapiti\SapitiClient;

ini_set('log_errors', 0);

require_once 'vendor/autoload.php';

$publicKey='BC6A1EB9-FBD5-CF44-9E28-C2618E7A5ACD';
$privateKey='ae1791a0-8b86-11ea-a036-a63297441bb5';

$client = new SapitiClient($publicKey,$privateKey, false);
echo $client->System()->ping().' from '. $client->getLastApiResponse()->getEnvironment()."\n";
echo $client->System()->authenticate()->getLabel()."\n";
$events = $client->Agenda()->getEvents(0);

$i=1;
/** @var Event $event */
foreach($events as $event) {
	echo $i.') '.$event->getId().' '.$event->getStatus()->getLabel().' '.$event->getAttraction()->getLabel()."\n";
	$i++;
}

//echo $client->getLastApiResponse()->getRawJson();
//echo $client->getLastApiResponse()->getDateTime()->format('Y-m-d H:i:s')."\n";
//var_dump($client->System()->pingParams([1=>"youpi","prout"=>"hdg jhgj dsgh j"]));