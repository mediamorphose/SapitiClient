<?php


namespace Sapiti\Objects\Shop;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Status;

class Order extends ApiObject
{

	const STATUS_CANCELLED = -10;
	const STATUS_CREATING = 0;
	const STATUS_CONFIRMED = 1;
	const STATUS_PAID = 15;
	const STATUS_COMPLETED = 30;

	protected $name = '';
	protected $contactId = '';
	protected $infoUrl = '';
	/** @var Status|null */
	protected $status = null;

	protected $created = null;
	protected $expires = null;


	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Order $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['name'])) $result->setName($data['name']);
		if (isset($data['contactid'])) $result->setContactId($data['contactid']);
		if (isset($data['info_url'])) $result->setInfoUrl($data['info_url']);

		if(isset($data['created']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['created']);
			$result->setCreated($date);
		}

		if(isset($data['expires']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['expires']);
			$result->setExpires($date);
		}

		if(isset($data['status'])) {
			$result->setStatus(Status::getFromArray($data['status']));
		}

		return $result;
	}


	/**
	 * @return string
	 */
	public function getContactId(): string
	{
		return $this->contactId;
	}

	/**
	 * @param string $contactId
	 */
	public function setContactId(string $contactId): void
	{
		$this->contactId = $contactId;
	}

	/**
	 * @return string
	 */
	public function getInfoUrl(): string
	{
		return $this->infoUrl;
	}

	/**
	 * @param string $infoUrl
	 */
	public function setInfoUrl(string $infoUrl): void
	{
		$this->infoUrl = $infoUrl;
	}


	/**
	 * @return Status|null
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param Status|null $status
	 */
	public function setStatus(Status $status=null)
	{
		$this->status = $status;
	}

	/**
	 * @param \DateTime|null $created
	 */
	public function setCreated(\DateTime $created=null)
	{
		$this->created = $created;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @param \DateTime|null $expires
	 */
	public function setExpires(\DateTime $expires=null)
	{
		$this->expires = $expires;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getExpires()
	{
		return $this->expires;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}




}