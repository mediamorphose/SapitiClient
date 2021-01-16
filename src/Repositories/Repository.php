<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Objects\System\ApiResponse;
use Sapiti\SapitiClient;

class Repository
{
	/** @var SapitiClient  */
	protected $client=null;

	protected $cacheDuration=60;

	/** @var null|ApiResponse */
	protected $lastAPIResponse=null;


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
	 * @return ApiResponse
	 * @throws ApiException
	 * @throws \Sapiti\Exceptions\CurlException
	 * @throws \Sapiti\Exceptions\InvalidHTTPMethodException
	 * @throws \Sapiti\Exceptions\JsonException
	 */
	protected function getAPIResponse(string $url, array $params=[], $method='GET') {

		$cache = $this->getClient()->getCachePool();

		$stringId=$url.$method.json_encode($params).$this->getClient()->getPublicKey().$this->getClient()->getLanguage();
		$key = hash('crc32c',$stringId);

		$cacheItem = $cache->getItem($key);

		/** @var ApiResponse $cacheInfo */
		$cacheInfo = $cacheItem->get();
		if($cacheItem->isHit() && $cacheInfo) {
			$cacheInfo->setCached(true);
			$this->lastAPIResponse=$cacheInfo;
			return $cacheInfo;
		}

		$data = $this->getClient()->getAuthenticationParams();
		$data = $this->getClient()->addListLimitParams($data, isset($params['size'])?$params['size']:0, isset($params['startposition'])?$params['startposition']:0);

		$data = array_merge($data, $params);

		$apiResponse = $this->getClient()->callAPI($url,$method,$data);
		$apiError = $apiResponse->getApiError();
		if ($apiError) throw new ApiException($apiError, null);
		if($this->cacheDuration>0 && $method=='GET') {
			$cacheItem->expiresAfter($this->getCacheDuration());
			$cache->save($cacheItem->set($apiResponse));
		}
		$this->lastAPIResponse=$apiResponse;
		return $apiResponse;
	}

	/**
	 * @return int
	 */
	public function getCacheDuration(): int
	{
		return $this->cacheDuration;
	}

	/**
	 * @param int $cacheDuration
	 */
	public function setCacheDuration(int $cacheDuration): void
	{
		$this->cacheDuration = $cacheDuration;
	}

	/**
	 * @return ApiResponse|null
	 */
	public function getLastAPIResponse(): ?ApiResponse
	{
		return $this->lastAPIResponse;
	}



}