<?php


namespace Sapiti\Objects\AccessControl;


use Sapiti\Objects\ApiObject;

class Device extends ApiObject
{

	protected $lastContact=null;
	protected $keys='';


	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Device $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['key'])) $result->setKeys($data['firstname']);
		if(isset($data['lastcontact']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['lastcontact']);
			$result->setLastContact($date);
		}
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





}