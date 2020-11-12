<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;


class Stream extends Repository
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
		$apiResponse = $this->getAPIResponse('streams',$params,'GET');
		return \Sapiti\Objects\Streaming\Stream::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return \Sapiti\Objects\Streaming\Stream|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStream(string $id) {
		$apiResponse = $this->getAPIResponse('streams/'.$id,[],'GET');
		return \Sapiti\Objects\Streaming\Stream::getFromArray($apiResponse->getResponse());
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
	public function getControlStreamAccess(string $id, string $contactId) {
		$apiResponse = $this->getAPIResponse('streams/'.$id.'/control',['contactid'=>$contactId],'GET');
		return\Sapiti\Objects\Contact\Contact::getFromArray($apiResponse->getResponse());
	}






}