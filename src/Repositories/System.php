<?php
namespace Sapiti\Repositories;

class System extends Repository
{
	/**
	 * This simple call returns 'pong'
	 *
	 * @return mixed|string
	 * @throws \Sapiti\Exceptions\CurlException
	 * @throws \Sapiti\Exceptions\InvalidHTTPMethodException
	 * @throws \Sapiti\Exceptions\JsonException
	 */
	public function ping() {
		$apiResponse = $this->getClient()->callAPI('ping','GET');
		$responseArray = $apiResponse->getResponse();
		if(isset($responseArray['message']))
			return $responseArray['message'];
		return '';
	}

	/**
	 * This function return the provided array after the api call
	 *
	 * @param array $data
	 * @return array|mixed
	 * @throws \Sapiti\Exceptions\CurlException
	 * @throws \Sapiti\Exceptions\InvalidHTTPMethodException
	 * @throws \Sapiti\Exceptions\JsonException
	 */
	public function pingParams($data = []) {
		if (sizeof($data)==0) return $data;
		$apiResponse = $this->getClient()->callAPI('ping','GET',$data);
		$responseArray = $apiResponse->getResponse();
		if(isset($responseArray['params']))
			return $responseArray['params'];
		return [];
	}

	public function mirror() {

	}


}