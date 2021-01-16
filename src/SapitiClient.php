<?php
namespace Sapiti;

use Psr\Cache\CacheItemPoolInterface;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\System\ApiResponse;
use Sapiti\Repositories\Agenda;
use Sapiti\Repositories\Catalogue;
use Sapiti\Repositories\Contact;
use Sapiti\Repositories\Newsletter;
use Sapiti\Repositories\Shop;
use Sapiti\Repositories\System;
use Stash\Driver\FileSystem;
use Stash\Pool;

class SapitiClient
{
	const API_PROD_SERVER_URL = 'https://sapiti.net/';
	const API_TEST_SERVER_URL = 'https://sapiti.ovh/';
	const API_DEV_SERVER_URL = 'http://sapiti.local/';

	const MODE_DEV = -1;
	const MODE_PROD = 0;
	const MODE_TEST = 1;

	protected $apiVersion = 'v1';
	protected $mode = self::MODE_TEST;
	protected $publicKey='';
	protected $privateKey='';
	protected $language='fr';

	/** @var APIResponse */
	protected $lastResponse= null;

	protected $lastRequestJSONParam= '';
	protected $lastRequestURL= '';


	/** @var CacheItemPoolInterface|null $cachePool  */
	protected $cachePool = null;

	/**
	 * SapitiClient constructor.
	 * @param $publicKey
	 * @param $privateKey
	 * @param $mode
	 */
	public function __construct($publicKey, $privateKey, $mode=self::MODE_TEST)	{
		$this->publicKey=$publicKey;
		$this->privateKey=$privateKey;

		$this->systemRepository= new System($this);
		$this->agendaRepository= new Agenda($this);
		$this->contactRepository= new Contact($this);
		$this->newsletterRepository= new Newsletter($this);
		$this->catalogueRepository= new Catalogue($this);
		$this->shopRepository= new Shop($this);
		$this->setMode($mode);
	}

	public function getAuthenticationParams() {
		$timeStamp= date('c');
		$publicKey = $this->publicKey;
		$privateKey = $this->privateKey;
		$stringToEncore=$publicKey.$timeStamp;

		$signature = hash_hmac("sha256", $stringToEncore, $privateKey);

		$params= [
			'publickey'=>$publicKey,
			'timestamp'=>$timeStamp,
			'signature'=>$signature,
			'language'=>strtolower($this->language)
		];

		return $params;
	}

	public function addListLimitParams(array $data=null,$size=0, $startPosition=0) {
		if($size>0) {
			$data['entry_count']=$size;
			$data['entry_start']=$startPosition;
		}
		if($startPosition>0) {
			$data['entry_start']=$startPosition;
		}
		return $data;
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

		if(true) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}

		if (!is_array($body)) $body = [];

		$json = json_encode($body);

		$this->lastRequestJSONParam=$json;
		$this->lastRequestURL=$full_url;

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json)
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

		$json = curl_exec($ch);
		if ($json === false) throw new CurlException($ch);
		curl_close($ch);

		$data = @json_decode($json, true);
		if (is_null($data)) {
			$jsonException = new JsonException();
			$jsonException->setJsonCode($json);
			throw $jsonException;
		}

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
	 * @var Agenda
	 */
	protected $agendaRepository=null;

	/**
	 * @return Agenda
	 */
	public function Agenda()
	{
		return $this->agendaRepository;
	}

	/**
	 * @var Contact
	 */
	protected $contactRepository=null;

	/**
	 * @return Contact
	 */
	public function Contact()
	{
		return $this->contactRepository;
	}

	/**
	 * @var Newsletter
	 */
	protected $newsletterRepository=null;

	/**
	 * @return Newsletter
	 */
	public function Newsletter()
	{
		return $this->newsletterRepository;
	}


	/**
	 * @var Shop
	 */
	protected $shopRepository=null;

	/**
	 * @return Shop
	 */
	public function Shop()
	{
		return $this->shopRepository;
	}

	/**
	 * @var Catalogue
	 */
	protected $catalogueRepository=null;

	/**
	 * @return Catalogue
	 */
	public function Catalogue()
	{
		return $this->catalogueRepository;
	}


	/**
	 * @param $value
	 */
	public function setMode($value) {
		$this->mode=$value;
	}

	/**
	 * @return string
	 */
	protected function getGeneralApiURL() {
		switch ($this->mode) {
			case self::MODE_TEST:
				return self::API_TEST_SERVER_URL.$this->apiVersion.'';
			case self::MODE_DEV:
				return self::API_DEV_SERVER_URL.$this->apiVersion.'';
			case self::MODE_PROD:
				return self::API_PROD_SERVER_URL.$this->apiVersion.'';
			default:
				return self::API_TEST_SERVER_URL.$this->apiVersion.'';
		}
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

	/**
	 * @return string
	 */
	public function getPublicKey(): string
	{
		return $this->publicKey;
	}

	/**
	 * @return string
	 */
	public function getPrivateKey(): string
	{
		return $this->privateKey;
	}

	/**
	 * @return CacheItemPoolInterface
	 */
	public function getCachePool(): ?CacheItemPoolInterface
	{
		if(is_null($this->cachePool)) {
			$driver = new FileSystem(array());
			$pool = new Pool($driver);
			$this->setCachePool($pool);
		}
		return $this->cachePool;
	}

	/**
	 * @param CacheItemPoolInterface|null $cachePool
	 */
	public function setCachePool(?CacheItemPoolInterface $cachePool): void
	{
		$this->cachePool = $cachePool;
	}

	/**
	 * @return string
	 */
	public function getLanguage(): string
	{
		return $this->language;
	}

	/**
	 * @param string $language
	 */
	public function setLanguage(string $language): void
	{
		$this->language = $language;
	}

	/**
	 * @return string
	 */
	public function getLastRequestJSONParam(): string
	{
		return $this->lastRequestJSONParam;
	}

	/**
	 * @return string
	 */
	public function getLastRequestURL(): string
	{
		return $this->lastRequestURL;
	}


}