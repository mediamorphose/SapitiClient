<?php
use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Venue;
use Sapiti\Objects\Catalogue\Stream;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let s list the streams... (enter key)');

//region LIST EVENTS
$streams = $client->Catalogue()->getStreams(['limit'=>100]);

$i=1;$lastId='';
/** @var Stream $stream */
foreach($streams as $stream) {
	$lastId = $stream->getId();
	echo "----------------\n";
	echo $i.') '.$stream->getLabel()."\n";
	echo "----------------\n";
	echo 'This stream as the following status : '.$stream->getStatus()->getLabel().'('.$stream->getStatus()->getId().")\n";
	echo 'The venue is : '.$stream->getVenue()->getLabel().' with address : '.$stream->getVenue()->getAddressL1().' '.$stream->getVenue()->getAddressPostalCode().' '.$stream->getVenue()->getAddressCity()."\n";
	echo 'The stream shopping link is : '.$stream->getShopUrl()."\n";
	echo 'The stream link is : '.$stream->getUrl()."\n";
	echo 'The stream image url is : '.$stream->getAttraction()->getImageURL()."\n";
	echo 'The stream description is : '.substr($stream->getDescription(),0,255)."...\n";
	$i++;
}
if($lastId) {
	$stream=$client->Catalogue()->getStream($lastId);
	echo 'The last stream is  : '.$stream->getId()."\n";

	readline('Lets control access code... (enter key)');

	$result=-1;

	try {
		$result = $client->Catalogue()->getControlStreamAccessWithAccessCode($lastId,'UWGTD7LGUGF2');
	}
	catch(Exception $e){
		echo 'Error : '.$e->getMessage()."\n";
	}

	switch ($result) {
		case -1:
			echo "Access denied";
			break;
		case 1:
			echo "Access granted";
			break;
		case 10:
			echo "Access granted (stream purchased)";
			break;
		case 20:
			echo "Access granted (related product purchased)";
			break;
		case 30:
			echo "Access granted (related pack purchased)";
			break;
	}
	echo "\n";

	readline('Lets control contact id... (enter key)');

	$result=-1;

	try {
		$result = $client->Catalogue()->getControlStreamAccessWithContactId($lastId,'F80F12C8-897B-1CEF-7668-8FA49845EE0D');
	}
	catch(Exception $e){
		echo 'Error : '.$e->getMessage()."\n";
	}

	switch ($result) {
		case -1:
			echo "Access denied";
			break;
		case 1:
			echo "Access granted";
			break;
		case 10:
			echo "Access granted (stream purchased)";
			break;
		case 20:
			echo "Access granted (related product purchased)";
			break;
		case 30:
			echo "Access granted (related pack purchased)";
			break;
	}


	echo "\n";


}
$lastStreamId=$lastId;
//endregion




