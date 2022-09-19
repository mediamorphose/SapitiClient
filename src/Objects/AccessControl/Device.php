<?php


namespace Sapiti\Objects\AccessControl;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Client;

class Device extends ApiObject
{

	protected $lastContact=null;
	protected $keys='';

	/** @var ?Client  */
	protected $client=null;


	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Device $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['key'])) $result->setKeys($data['firstname']);
		if(isset($data['lastcontact']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['lastcontact']);
			$result->setLastContact($date);
		}
		if(isset($data['client']))
			$result->setClient(Client::getFromArray($data['client']));
		return $result;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastContact(): ?\DateTime
	{
		return $this->lastContact;
	}

	/**
	 * @param \DateTime|null $lastContact
	 */
	public function setLastContact(\DateTime $lastContact=null): void
	{
		$this->lastContact = $lastContact;
	}

	/**
	 * @return string
	 */
	public function getKeys(): string
	{
		return $this->keys;
	}

	/**
	 * @param string $keys
	 */
	public function setKeys(string $keys): void
	{
		$this->keys = $keys;
	}

	/**
	 * @return Client|null
	 */
	public function getClient(): ?Client
	{
		return $this->client;
	}

	/**
	 * @param Client|null $client
	 */
	public function setClient(?Client $client): void
	{
		$this->client = $client;
	}







}