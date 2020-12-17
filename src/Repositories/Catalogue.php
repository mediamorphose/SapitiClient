<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Catalogue\Stream;

class Catalogue extends Repository
{
	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStreams(array $params=[]) {
		$apiResponse = $this->getAPIResponse('catalogue/streams',$params,'GET');
		return Stream::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return Stream|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStream(string $id) {
		$apiResponse = $this->getAPIResponse('catalogue/streams/'.$id,[],'GET');
		return Stream::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @param $contactId
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Contact\Contact|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getControlStreamAccessWithContactId(string $id, string $contactId) {
		$apiResponse = $this->getAPIResponse('catalogue/streams/'.$id.'/control',['contactid'=>$contactId],'GET');
		return $apiResponse->getResponse();
	}

	/**
	 * @param string $id
	 * @param string $accessCode
	 * @return \Sapiti\Objects\Contact\Contact
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getControlStreamAccessWithAccessCode(string $id, string $accessCode) {
		$apiResponse = $this->getAPIResponse('catalogue/streams/'.$id.'/control',['accesscode'=>$accessCode],'GET');
		return  $apiResponse->getResponse();
	}





}