<?php
use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Agenda\Venue;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let s list the first 100 events... (enter key)');

//region LIST EVENTS
$events = $client->Agenda()->getEvents(['limit'=>100]);

$i=1;$lastId='';$lastEventIdWithTimeSlots='';
/** @var Event $event */
foreach($events as $event) {
	$lastId = $event->getId();
	echo "----------------\n";
	echo $i.') '.$event->getAttraction()->getLabel()."\n";
	echo "----------------\n";
	echo 'This event date is : '.$event->getStartTime()->format('c')."\n";
	echo 'This event has time slots : '.$event->isHasTimeSlots()."\n";
	echo 'This event as the following status : '.$event->getStatus()->getLabel().'('.$event->getStatus()->getId().")\n";
	echo 'The venue is : '.$event->getVenue()->getLabel().' with address : '.$event->getVenue()->getAddressL1().' '.$event->getVenue()->getAddressPostalCode().' '.$event->getVenue()->getAddressCity()."\n";
	echo 'The serie shopping link is : '.$event->getSerie()->getShopUrl()."\n";
	echo 'The event shopping link is : '.$event->getShopUrl()."\n";
	echo 'The event image url is : '.$event->getAttraction()->getImageURL()."\n";
	echo 'The event description is : '.substr($event->getAttraction()->getDescription(),0,255)."...\n";
	echo 'The other stuff is : '.$event->getAttraction()->getDuration().'/'.$event->getAttraction()->getAdditionalDescription()."\n";
	echo 'The event notes are : '.$event->getNotes()."\n";
	$i++;

	if($event->isHasTimeSlots()) $lastEventIdWithTimeSlots=$lastId;
}
if($lastId) echo 'The last event is  : '.$client->Agenda()->getEvent($lastId)->getId()."\n";
$lastEventId=$lastId;

//endregion

readline('Let s list the attractions ... (enter key)');

//region LIST ATTRACTIONS
$attractions = $client->Agenda()->getAttractions();

$i=1;$lastId='';
/** @var Attraction $attraction */
foreach($attractions as $attraction) {
	$lastId = $attraction->getId();
	echo "----------------\n";
	echo $i.') '.$attraction->getLabel().' | '.$attraction->getNbEvents()." events\n";
	$i++;
}
if($lastId) echo 'The last one is  : '.$client->Agenda()->getAttraction($lastId)->getLabel()."...\n";
//endregion

readline('Let s list the venues... (enter key)');

//region LIST VENUES
$venues = $client->Agenda()->getVenues();

$i=1;$lastId='';
/** @var Venue $venue */
foreach($venues as $venue) {
	$lastId = $venue->getId();
	echo "----------------\n";
	echo $i.') '.$venue->getLabel()."\n";
	echo "----------------\n";
	echo 'This address is : '.$venue->getAddressL1().' '.$venue->getAddressPostalCode().' '.$venue->getAddressCity()."\n";
	$i++;
}
if($lastId) echo 'The last one is  : '.$client->Agenda()->getVenue($lastId)->getLabel()."\n";
//endregion

readline('Let s list the attractions categories... (enter key)');

//region LIST CATEGORIES
$categories = $client->Agenda()->getCategories();

$i=1;$lastId='';
/** @var Category $category */
foreach($categories as $category) {
	$lastId = $category->getId();
	echo "----------------\n";
	echo $i.') '.$category->getLabel()."\n";
	$i++;
}
if($lastId) echo 'The last one is  : '.$client->Agenda()->getCategory($lastId)->getLabel()."...\n";
//endregion
