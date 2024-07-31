<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;


class Newsletter extends Repository
{
	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getNewsletters(array $params=[]) {
		$apiResponse = $this->getAPIResponse('contacts/newsletters/',$params,'GET');
		return \Sapiti\Objects\Contact\Newsletter::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Contact\Newsletter|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getNewsletter(string $id) {
		$apiResponse = $this->getAPIResponse('contacts/newsletters/'.$id,[],'GET');
		return \Sapiti\Objects\Contact\Newsletter::getFromArray($apiResponse->getResponse());
	}

	public function subscribeContactToNewsletter(\Sapiti\Objects\Contact\Contact $contact, \Sapiti\Objects\Contact\Newsletter $newsletter) {
		$apiResponse = $this->getAPIResponse('contacts/newsletters/'.$newsletter->getId().'/'.$contact->getId(),[],'POST');
		return $apiResponse->isSuccess();
	}

	public function unsubscribeContactToNewsletter(\Sapiti\Objects\Contact\Contact $contact, \Sapiti\Objects\Contact\Newsletter $newsletter) {
		$apiResponse = $this->getAPIResponse('contacts/newsletters/'.$newsletter->getId().'/'.$contact->getId(),[],'DELETE');
		return $apiResponse->isSuccess();
	}




}