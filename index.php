<?php

use Sapiti\Objects\Agenda\Event;
use Sapiti\SapitiClient;

ini_set('log_errors', 0);

require_once 'vendor/autoload.php';

/** Replace with the provided keys */
$publicKey='XXXXXXXXXXX';
$privateKey='XXXXXXXXXXXX';

/*Create the Sapiti API Client in test mode */
$client = new SapitiClient($publicKey,$privateKey, false);

/*Test the connection to the server */
echo '\''.$client->System()->ping().'\' from our '. $client->getLastApiResponse()->getEnvironment()." environment\n";

/*Ouput your authentication label */
echo 'Hello to '.$client->System()->authenticate()->getLabel()."\n";

/*Take the first 10 events the published events */
$events = $client->Agenda()->getEvents(10);

$i=1;
/** @var Event $event */
foreach($events as $event) {
	echo "----------------\n";
	echo $i.') '.$event->getAttraction()->getLabel()."\n";
	echo "----------------\n";
	echo 'This event date is : '.$event->getStartTime()->format('c')."\n";
	echo 'This event as the following status : '.$event->getStatus()->getLabel()."\n";
	echo 'The venue is : '.$event->getVenue()->getLabel().' with address : '.$event->getVenue()->getAddressL1().' '.$event->getVenue()->getAddressPostalCode().' '.$event->getVenue()->getAddressCity()."\n";
	echo 'The serie shopping link is : '.$event->getSerie()->getShopUrl()."\n";
	echo 'The event shopping link is : '.$event->getShopUrl()."\n";
	echo 'The event image url is : '.$event->getAttraction()->getImageURL()."\n";
	echo 'The event description is : '.substr($event->getAttraction()->getDescription(),0,255)."...\n";
	$i++;
}
