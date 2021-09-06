<?php

use Sapiti\Objects\Catalogue\Pack;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let s list the packs... (enter key)');

//region LIST EVENTS
$packs = $client->Catalogue()->getPacks(['limit'=>100]);

$i=1;$lastId='';
/** @var Pack $pack */
foreach($packs as $pack) {
	$lastId = $pack->getId();
	echo "----------------\n";
	echo $i.') '.$pack->getLabel()."\n";
	echo "----------------\n";
	echo 'The pack shopping link is : '.$pack->getShopUrl()."\n";
	echo 'The pack min max  is : '.$pack->getItemNbMin().' '.$pack->getItemNbMax()."\n";
	echo 'The pack description is : '.substr($pack->getDescription(),0,255)."...\n";
	$i++;
}
if($lastId) {
	$pack=$client->Catalogue()->getPack($lastId);
	echo 'The last pack is  : '.$pack->getLabel()."\n";
}
$lastPackId=$lastId;
//endregion




