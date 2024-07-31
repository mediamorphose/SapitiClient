<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Business\Application;

class System extends Repository
{
	/**
	 * This simple call returns 'pong'
	 *
	 * @return mixed|string
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function ping() {
		$apiResponse = $this->getClient()->callAPI('ping/','GET', ['language'=>$this->getClient()->getLanguage()]);
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
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function pingParams($data = []) {
		if (sizeof($data)==0) return $data;
		$apiResponse = $this->getClient()->callAPI('ping/','GET',$data);
		$responseArray = $apiResponse->getResponse();
		if(isset($responseArray['params']))
			return $responseArray['params'];
		return [];
	}

	/**
	 * @return Application|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function authenticate() {
		$data = $this->getClient()->getAuthenticationParams();
		$apiResponse = $this->getClient()->callAPI('system/authenticate/','GET',$data);
		$apiError = $apiResponse->getApiError();
		if ($apiError) throw new ApiException($apiError, null);
		return Application::getFromArray($apiResponse->getResponse());
	}


}