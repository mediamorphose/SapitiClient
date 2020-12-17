<?php

use Sapiti\Objects\Shop\Order;
use Sapiti\Objects\Shop\Price;
use Sapiti\Objects\Shop\ProductCategory;
use Sapiti\Objects\Shop\Stock;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('getting stock from last listed event...');
if (!isset($lastEventId)) $lastEventId='xxx';

$stocks = $client->Shop()->getStocks(['eventid'=>$lastEventId]);
$i=1;$lastStockId='';
/** @var Stock $stock */
foreach($stocks as $stock) {
	$lastStockId = $stock->getId();
	echo "----------------\n";
	echo $i.') '.$stock->getLabel().' '.$stock->getShopUrl()."\n";
	echo "Categories : \n";
	/** @var ProductCategory $productCategory */
	foreach($stock->getProductCategories() as $productCategory) {
		echo '* '.$productCategory->getLabel().' '.$productCategory->getCapacityFree()."\n";
		/** @var Price $price */
		foreach($productCategory->getPrices() as $price) {
			echo '*** '.$price->getLabel().' '.$price->getPrice()."\n";
		}
	}
	$i++;
}
if($lastStockId) echo 'The last one is  : '.$client->Shop()->getStock($lastStockId)->getLabel()."\n";
