<?php

use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Contact\Contact;
use Sapiti\Objects\Shop\Price;
use Sapiti\Objects\Shop\Product;
use Sapiti\Objects\Shop\ProductCategory;
use Sapiti\Objects\Shop\Stock;
use Sapiti\Objects\Shop\StockRequest;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let s create an order');

$quantityToOrder = 2;

$orderId='';
$selectedEvent='';
$selectedStock='';
$selectedCategory='';
$selectedPrice='';
//region LIST EVENTS
$events = $client->Agenda()->getEvents(['limit'=>100]);
/** @var Event $event */
foreach($events as $event) {
	$eventId = $event->getId();
	$stocks = $client->Shop()->getStocks(['eventid'=>$eventId]);
	/** @var Stock $stock */
	foreach($stocks as $stock) {
		/** @var ProductCategory $productCategory */
		foreach($stock->getProductCategories() as $productCategory) {
			/** @var Price $price */
			foreach($productCategory->getPrices() as $price) {
				if($productCategory->getCapacityFree()>$quantityToOrder){
					$selectedEvent = $event;
					$selectedStock=$stock;
					$selectedCategory=$productCategory;
					$selectedPrice=$price;
					break 4;
				}
			}
		}
	}
}

if($selectedPrice) {
	print_r("Booking $quantityToOrder seats (".$selectedCategory->getLabel().'/'.$selectedPrice->getLabel().") from ".$selectedEvent->getStartTime()->format('c'));
	$stockRequest = new StockRequest();
	$stockRequest->setQuantity($quantityToOrder);
	$stockRequest->setCategoryId($selectedCategory->getId());
	$stockRequest->setPriceId($selectedPrice->getId());
	$stockRequest->setStockId($selectedStock->getId());


	$products = $client->Shop()->requestStock([$stockRequest]);

	if(sizeof($products)!=$quantityToOrder) {
		die('no enough stock');
	}

	$i=0;
	$orderId='';
	/** @var Product $product */
	foreach($products as $product) {
		$lastId = $product->getId();
		$orderId=$product->getOrderId();
		echo "----------------\n";
		echo $i.') '.$product->getTicket()->getPositionLabel().' '.$product->getCategory()->getLabel()."\n";
		$i++;
	}


	$order = $client->Shop()->getOrder($orderId);

	$newContact = new Contact();
	$lastName = 'Do'.microtime(true);
	$newContact->setFirstName('John');
	$newContact->setLastName($lastName);
	$newContact->setEmail($lastName.'@'.$lastName.'.com');
	$newContact->setMobilePhone('1-555-99 99 99');
	$newContact = $client->Contact()->createContact($newContact);

	echo 'new order :'.$order->getId()."\n";

	$client->Shop()->confirmOrder($order->getId(),$newContact->getId());
	$client->Shop()->setMolliePaymentId($order->getId(),'xxxx-xxx-xxxx');



}


