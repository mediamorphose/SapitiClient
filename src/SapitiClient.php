<?php
namespace Sapiti;

use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\System\ApiResponse;
use Sapiti\Repositories\System;

class SapitiClient
{
	const API_PROD_SERVER_URL = 'https://sapiti.net/';
	const API_TEST_SERVER_URL = 'http://sapiti.local/';

	protected $apiVersion = 'v1';
	protected $testMode = false;
	protected $publicKey='';
	protected $privateKey='';

	/** @var APIResponse */
	protected $lastResponse= null;

	public function __construct($publicKey, $privateKey='')	{
		$this->publicKey=$publicKey;
		$this->privateKey=$privateKey;

		$this->systemRepository= new System($this);
	}

	/**
	 * @param $functionName
	 * @param $httpMethod
	 * @param null $body
	 * @return APIResponse
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function callAPI($functionName, $httpMethod, $body = null)
	{
		$httpMethod = strtoupper($httpMethod);
		if (!in_array($httpMethod, array('GET', 'POST', 'PATCH', 'DELETE'))) throw new InvalidHTTPMethodException();
		$server_url = $this->getGeneralApiURL();
		$full_url = implode('/', array($server_url, ltrim($functionName, '/')));

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $full_url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);

		if($this->testMode) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}

		if (!is_array($body)) $body = [];
		//todo add authentication

		$json = json_encode($body);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json)
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

		$json = curl_exec($ch);
		if ($json === false) throw new CurlException($ch);
		curl_close($ch);

		$data = @json_decode($json, true);
		if (is_null($data)) throw new JsonException();

		$result = new APIResponse($data, $json);
		$this->lastResponse=$result;
		return $result;
	}

	/**
	 * @var System
	 */
	protected $systemRepository=null;

	/**
	 * @return System
	 */
	public function System()
	{
		return $this->systemRepository;
	}



	/**
	 * Set to true if you want to use the test server
	 *
	 * @param $bool
	 */
	public function setTestMode($bool) {
		$this->testMode=$bool;
	}

	protected function getGeneralApiURL() {
		return ($this->testMode?self::API_TEST_SERVER_URL:self::API_PROD_SERVER_URL).$this->apiVersion.'';
	}

	/**
	 * Set your access public key
	 *
	 * @param string $publicKey
	 */
	public function setPublicKey(string $publicKey)
	{
		$this->publicKey = $publicKey;
	}

	/**
	 * Set your access private key
	 *
	 * @param string $privateKey
	 */
	public function setPrivateKey(string $privateKey)
	{
		$this->privateKey = $privateKey;
	}

	/**
	 * Set api version
	 *
	 * @param string $apiVersion
	 */
	public function setApiVersion(string $apiVersion)
	{
		$this->apiVersion = $apiVersion;
	}

	/**
	 * @return APIResponse
	 */
	public function getLastApiResponse(): APIResponse
	{
		return $this->lastResponse;
	}









}