<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\SapitiClient;

class Repository
{
	/** @var SapitiClient  */
	protected $client=null;

	public function __construct(SapitiClient $client)
	{
		$this->client=$client;
	}

	/**
	 * @return SapitiClient
	 */
	protected function getClient(): SapitiClient
	{
		return $this->client;
	}

	/**
	 * @param string $url
	 * @param array $params
	 * @param string $method
	 * @return \Sapiti\Objects\System\ApiResponse
	 * @throws ApiException
	 * @throws \Sapiti\Exceptions\CurlException
	 * @throws \Sapiti\Exceptions\InvalidHTTPMethodException
	 * @throws \Sapiti\Exceptions\JsonException
	 */
	protected function getAPIResponse(string $url, array $params=[], $method='GET') {
		$data = $this->getClient()->getAuthenticationParams();
		$data = $this->getClient()->addListLimitParams($data, isset($params['size'])?$params['size']:0, isset($params['startposition'])?$params['startposition']:0);

		$data = array_merge($data, $params);

		$apiResponse = $this->getClient()->callAPI($url,$method,$data);
		$apiError = $apiResponse->getApiError();
		if ($apiError) throw new ApiException($apiError, null);
		return $apiResponse;
	}


}