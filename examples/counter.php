<?php
use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Agenda\Venue;
use Sapiti\Objects\Shop\Counter;
use Sapiti\Objects\Shop\CounterSession;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let\'s list the counters');

//region LIST EVENTS
$counters = $client->Shop()->getCounters();

$i=1;$lastCounterId='';
/** @var Counter $counter */
foreach($counters as $counter) {
	$lastCounterId = $counter->getId();
	echo "----------------\n";
	echo $i.') '.$counter->getLabel()."\n";
	echo "----------------\n";
	$i++;

}
if($lastCounterId) {
	echo 'The last counter id is  : '.$client->Shop()->getCounter($lastCounterId)->getId()."\n";
	readline('Let s create a counter session ... (enter key)');
	$currentCounterSession = $client->Shop()->startCounterSession($lastCounterId,1000,'User name');
	echo 'Let s list last 10 sessions'."\n";
	$counterSessions = $client->Shop()->getCounterSessions($lastCounterId, ['limit'=>10]);
	$i=1;
	/** @var CounterSession $counterSession */
	foreach($counterSessions as $counterSession) {
		$lastId = $counterSession->getId();
		echo "----------------\n";
		echo $i.') '.$counterSession->getId().' | '.$counterSession->getUserLabel().' | ';
		echo($counterSession->getStartTime()?$counterSession->getStartTime()->format('c'):'');
		echo(' => ');
		echo($counterSession->getEndTime()?$counterSession->getEndTime()->format('c'):'');
		echo "\n";
		$i++;
	}
	echo 'Closing new session'."\n";
	$client->Shop()->stopCounterSession($currentCounterSession->getId(),5000,'Nothing particular');
}

