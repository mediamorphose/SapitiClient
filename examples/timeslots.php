<?php
use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Agenda\TimeSlot;
use Sapiti\Objects\Agenda\Venue;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;
if($lastEventIdWithTimeSlots) {
	readline('Let s list some timeslots... (enter key)');

//region LIST TIMESLOTS
	$timeSlots = $client->Agenda()->getTimeSlots(['eventid' => $lastEventIdWithTimeSlots, 'limit' => 10]);

	$i = 1;
	$lastId = '';
	/** @var TimeSlot $timeSlot */
	foreach ($timeSlots as $timeSlot) {
		$lastId = $timeSlot->getId();
		echo "----------------\n";
		echo $i . ') ' . $timeSlot->getStartTime()->format('c') . "\n";
		echo "----------------\n";
		echo 'The capacity is : ' . $timeSlot->getCapacity() . "\n";
		$i++;
	}
}
//endregion
