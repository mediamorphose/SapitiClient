<?php

use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Agenda\Venue;
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
echo 'Hello to '.$client->System()->authenticate()->getLabel()."\n";

/*Take the first 10 published events */
$events = $client->Agenda()->getEvents(['limit'=>10]);

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

readline('enter to continue...');
/*Take all venues */
$venues = $client->Agenda()->getVenues();

$i=1;
/** @var Venue $venue */
foreach($venues as $venue) {
	echo "----------------\n";
	echo $i.') '.$venue->getLabel()."\n";
	echo "----------------\n";
	echo 'This address is : '.$venue->getAddressL1().' '.$venue->getAddressPostalCode().' '.$venue->getAddressCity()."\n";
	$i++;
}

readline('enter to continue...');
/*Take all venues */
$categories = $client->Agenda()->getCategories();

$i=1;
/** @var Category $category */
foreach($categories as $category) {
	echo "----------------\n";
	echo $i.') '.$category->getLabel()."\n";
	$i++;
}

readline('enter to continue...');
/*Take all venues */
$attractions = $client->Agenda()->getAttractions(['keyword'=>'humour']);

$i=1;
/** @var Attraction $attraction */
foreach($attractions as $attraction) {
	echo "----------------\n";
	echo $i.') '.$attraction->getLabel()."\n";
	$i++;
}
