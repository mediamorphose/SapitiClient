<?php

use Sapiti\Objects\Shop\Product;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('getting product list for a orderid id...');

$products = $client->Product()->getProducts(['orderid'=>'6F0591E1-6B65-F2A3-B837-631150FF3C6E']);
$i=1;$lastId='';
/** @var Product $product */
foreach($products as $product) {
	$lastId = $product->getId();
	echo "----------------\n";
	echo $i.') '.$product->getTicket()->getPositionLabel().' '.$product->getCategory()->getLabel()."\n";
	$i++;
}
if($lastId) echo 'The last one is  : '.$client->Product()->getProduct($lastId)->getLabel()."\n";
