<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;


class Contact extends Repository
{
	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getContacts(array $params=[]) {
		$apiResponse = $this->getAPIResponse('contacts/',$params,'GET');
		return \Sapiti\Objects\Contact\Contact::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Contact\Contact|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getContact(string $id) {
		$apiResponse = $this->getAPIResponse('contacts/'.$id,[],'GET');
		return \Sapiti\Objects\Contact\Contact::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param \Sapiti\Objects\Contact\Contact $contact
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Contact\Contact|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function updateContact(\Sapiti\Objects\Contact\Contact $contact) {
		$dataArray = \Sapiti\Objects\Contact\Contact::toArray($contact);
		$apiResponse = $this->getAPIResponse('contacts/'.$contact->getId(),$dataArray,'PATCH');
		return \Sapiti\Objects\Contact\Contact::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param \Sapiti\Objects\Contact\Contact $contact
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Contact\Contact|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function createContact(\Sapiti\Objects\Contact\Contact $contact, $stockId=null) {
		$dataArray = \Sapiti\Objects\Contact\Contact::toArray($contact);
        if($stockId) $dataArray['stockid']=$stockId;
		$apiResponse = $this->getAPIResponse('contacts/',$dataArray,'POST');
		return \Sapiti\Objects\Contact\Contact::getFromArray($apiResponse->getResponse());
	}



}