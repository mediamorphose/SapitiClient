<?php

use Sapiti\Objects\Contact\Contact;
use Sapiti\Objects\Contact\Newsletter;
use Sapiti\SapitiClient;

/** @var SapitiClient $client */
global $client;

readline('Let s create a new contact... (enter key)');

$newContact = new Contact();
$lastName = 'Do'.microtime(true);
$newContact->setFirstName('John');
$newContact->setLastName($lastName);
$newContact->setEmail($lastName.'@'.$lastName.'.com');
$newContact->setMobilePhone('1-555-99 99 99');
$newContact = $client->Contact()->createContact($newContact);
echo $newContact->getLabel().' created'."\n";

//region SEARCH CONTACTS

echo 'getting the list for this lastname'."\n";

$contacts = $client->Contact()->getContacts(['lastname'=>$lastName]);
$i=1;$lastId='';
/** @var Contact $contact */
foreach($contacts as $contact) {
	$lastId = $contact->getId();
	echo "----------------\n";
	echo $i.') '.$contact->getLabel()."\n";
	$i++;
}
if($lastId) echo 'The last one is  : '.$client->Contact()->getContact($lastId)->getLabel()."\n";

//endregion

readline('Let s list the newsletters ... (enter key)');

$newsletters = $client->Newsletter()->getNewsletters();
$i=1;$lastId='';
/** @var Newsletter $newsletter */
foreach($newsletters as $newsletter) {
	$lastId = $newsletter->getId();
	echo "----------------\n";
	echo $i.') '.$newsletter->getLabel()."\n";
	$i++;
}
if($lastId) {
	$lastNewsletter = $client->Newsletter()->getNewsletter($lastId);
	$result = $client->Newsletter()->subscribeContactToNewsletter($newContact,$lastNewsletter);
	if($result) echo $newContact->getLabel().' has been subscribed to '.$lastNewsletter->getLabel()."\n";
	$result = $client->Newsletter()->unsubscribeContactToNewsletter($newContact,$lastNewsletter);
	if($result) echo $newContact->getLabel().' has been unsubscribed to '.$lastNewsletter->getLabel()."\n";
}