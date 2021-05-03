<?php

use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Catalogue\Merchandising;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let s list the merchandising... (enter key)');

//region LIST EVENTS
$merchandisings = $client->Catalogue()->getMerchandisings(['limit'=>100]);

$i=1;$lastId='';
/** @var Merchandising $merchandising */
foreach($merchandisings as $merchandising) {
	$lastId = $merchandising->getId();
	echo "----------------\n";
	echo $i.') '.$merchandising->getLabel().' '.$merchandising->getId()."\n";
	echo 'The merchandising shopping link is : '.$merchandising->getShopUrl()."\n";
	echo 'The merchandising image url is : '.$merchandising->getImageUrl()."\n";
	/** @var Category $value */
	foreach ($merchandising->getCategories() as $value) {
		echo '-- Category : '.$value->getLabel()."\n";
	}

	$i++;
}
if($lastId) {
	$merchandising = $client->Catalogue()->getMerchandising($lastId);
	echo 'The last one is : '.$merchandising->getLabel()."\n";
}

$merchandisingCategories =$client->Catalogue()->getMerchandisingCategories(['limit'=>100]);

$i=1;$lastId='';

/** @var Category $cat */
foreach($merchandisingCategories as $cat) {
	$lastId = $cat->getId();
	echo "----------------\n";
	echo $i.') '.$cat->getLabel().' '.$cat->getId()."\n";
	$i++;
}
if($lastId) {
	$merchandisingCat = $client->Catalogue()->getMerchandisingCategory($lastId);
	echo 'The last one is : '.$merchandisingCat->getLabel()."\n";
}

$i=1;$lastId='';
