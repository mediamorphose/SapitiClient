<?php
namespace Sapiti;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\System\ApiResponse;
use Sapiti\Repositories\AccessControl;
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

	protected string $apiVersion = 'v1';
	protected int $mode = self::MODE_TEST;
	protected string $publicKey='';
	protected string $privateKey='';
	protected string $language='fr';

	protected ?ApiResponse $lastResponse= null;

	protected string $lastRequestJSONParam= '';
	protected string $lastRequestURL= '';


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
		$this->controlRepository= new AccessControl($this);
		$this->setMode($mode);
	}

	public function getAuthenticationParams(): array
    {
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

	public function addListLimitParams(array $data=null,$size=0, $startPosition=0): ?array
    {
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
	public function callAPI($functionName, $httpMethod, $body = null): ApiResponse
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

		//echo("\n".$full_url.'('.$httpMethod.') : '.$json);

		$this->lastRequestJSONParam=$json;
		$this->lastRequestURL=$full_url;

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json)
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

		$json = curl_exec($ch);
		//echo("\nresponse : ".$json);

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


	protected ?System $systemRepository=null;


	public function System(): ?System
    {
		return $this->systemRepository;
	}

	protected ?Agenda $agendaRepository=null;

	public function Agenda(): ?Agenda
    {
		return $this->agendaRepository;
	}

	protected ?Contact $contactRepository=null;


	public function Contact(): ?Contact
    {
		return $this->contactRepository;
	}


	protected ?Newsletter $newsletterRepository=null;


	public function Newsletter(): ?Newsletter
    {
		return $this->newsletterRepository;
	}



	protected ?Shop $shopRepository=null;

	public function Shop(): ?Shop
    {
		return $this->shopRepository;
	}


	protected ?Catalogue $catalogueRepository=null;


	public function Catalogue(): ?Catalogue
    {
		return $this->catalogueRepository;
	}


	protected ?AccessControl $controlRepository=null;


	public function AccessControl(): ?AccessControl
    {
		return $this->controlRepository;
	}



	public function setMode($value): void
    {
		$this->mode=$value;
	}


	protected function getGeneralApiURL(): string
    {
		switch ($this->mode) {
            case self::MODE_DEV:
				return self::API_DEV_SERVER_URL.$this->apiVersion;
			case self::MODE_PROD:
				return self::API_PROD_SERVER_URL.$this->apiVersion;
			default:
				return self::API_TEST_SERVER_URL.$this->apiVersion;
		}
	}


	public function setPublicKey(string $publicKey): void
    {
		$this->publicKey = $publicKey;
	}


	public function setPrivateKey(string $privateKey): void
    {
		$this->privateKey = $privateKey;
	}


	public function setApiVersion(string $apiVersion)
	{
		$this->apiVersion = $apiVersion;
	}


	public function getLastApiResponse(): APIResponse
	{
		return $this->lastResponse;
	}

	public function getPublicKey(): string
	{
		return $this->publicKey;
	}


	public function getPrivateKey(): string
	{
		return $this->privateKey;
	}


	public function getCachePool(): ?CacheItemPoolInterface
	{
		if(is_null($this->cachePool)) {
			$driver = new FileSystem(array());
			$pool = new Pool($driver);
			$this->setCachePool($pool);
		}
		return $this->cachePool;
	}


	public function setCachePool(?CacheItemPoolInterface $cachePool): void
	{
		$this->cachePool = $cachePool;
	}


	public function getLanguage(): string
	{
		return $this->language;
	}


	public function setLanguage(string $language): void
	{
		$this->language = $language;
	}


	public function getLastRequestJSONParam(): string
	{
		return $this->lastRequestJSONParam;
	}


	public function getLastRequestURL(): string
	{
		return $this->lastRequestURL;
	}


	public function getMode(): int
	{
		return $this->mode;
	}




}