<?php

use Sapiti\Objects\Shop\Order;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('getting order list for a contact id...');

$orders = $client->Order()->getOrders(['contactid'=>'77B8994B-D521-A2C2-FA06-982B5F1DAFD2']);
$i=1;$lastId='';
/** @var Order $order */
foreach($orders as $order) {
	$lastId = $order->getId();
	echo "----------------\n";
	echo $i.') '.$order->getLabel().' '.$order->getInfoUrl()."\n";
	$i++;
}
if($lastId) echo 'The last one is  : '.$client->Order()->getOrder($lastId)->getLabel()."\n";
