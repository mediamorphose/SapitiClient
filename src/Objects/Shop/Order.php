<?php


namespace Sapiti\Objects\Shop;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Status;

class Order extends ApiObject
{

	const STATUS_CANCELLED = -10;
	const STATUS_CREATING = 0;
	const STATUS_CONFIRMED = 1;
	const STATUS_TOPAY = 10;
    const STATUS_PARTIALLY_PAID = 12;
    const STATUS_PAID = 15;
    const STATUS_OVERPAID = 18;
	const STATUS_COMPLETED = 30;

	protected $name = '';
	protected $contactId = '';
	protected $infoUrl = '';
	/** @var Status|null */
	protected $status = null;

	protected $created = null;
	protected $expires = null;

    protected $notes = '';
    protected $metaData=[];


    static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Order $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['name'])) $result->setName($data['name']);
		if (isset($data['contactid'])) $result->setContactId($data['contactid']);
		if (isset($data['info_url'])) $result->setInfoUrl($data['info_url']);
        if (isset($data['notes'])) $result->setNotes($data['notes']);

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

        if(isset($data['metadata']) && is_array($data['metadata']))
            $result->setMetaData($data['metadata']);

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

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @return array
     */
    public function getMetaData(): array
    {
        return $this->metaData;
    }

    /**
     * @param array $metaData
     */
    public function setMetaData(array $metaData): void
    {
        $this->metaData = $metaData;
    }




}