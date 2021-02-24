<?php


namespace Sapiti\Objects\Catalogue;


use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Venue;
use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Client;
use Sapiti\Objects\Business\Status;

class Stream extends ApiObject
{

	const STATUS_ARCHIVED = -99;
	const STATUS_CANCELLED = -10;
	const STATUS_CONFIRMED = -1;
	const STATUS_NOTSTARTED = 0;
	const STATUS_PUBLISHED = 10;


	protected $startTime = false;
	protected $endTime = false;
	protected $accessEndTime = false;

	/** @var Client|null */
	protected $client = null;

	/** @var Status|null */
	protected $status = null;


	/** @var Venue */
	protected $venue = null;

	/** @var Attraction */
	protected $attraction = null;

	protected $description = '';
	protected $url = '';
	protected $shopUrl = '';
	protected $accessDuration = '';
	protected $freeAccessToPacks = false;
	protected $freeAccessToSeats = false;

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Stream|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Stream $result */
		$result = parent::getFromArray($data, $existingObject);

		if (isset($data['label'])) $result->setLabel($data['label']);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['url'])) $result->setUrl($data['url']);
		if (isset($data['shop_url'])) $result->setShopUrl($data['shop_url']);
		if (isset($data['access_duration'])) $result->setAccessDuration($data['access_duration']);
		if (isset($data['freeaccess_packs'])) $result->setFreeAccessToPacks($data['freeaccess_packs']);
		if (isset($data['freeaccess_seats'])) $result->setFreeAccessToSeats($data['freeaccess_seats']);
		if (isset($data['starttime'])) {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['starttime']);
			$result->setStartTime($date);
		}
		if (isset($data['endtime'])) {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['endtime']);
			$result->setEndTime($date);
		}
		if (isset($data['accessendtime'])) {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['accessendtime']);
			$result->setAccessEndTime($date);
		}

		if (isset($data['status'])) {
			$result->setStatus(Status::getFromArray($data['status']));
		}

		if (isset($data['venue']))
			$result->setVenue(Venue::getFromArray($data['venue']));
		if (isset($data['attraction']))
			$result->setAttraction(Attraction::getFromArray($data['attraction']));
		if (isset($data['client']))
			$result->setClient(Client::getFromArray($data['client']));


		return $result;
	}

	/**
	 * @return \DateTime|false
	 */
	public function getStartTime()
	{
		return $this->startTime;
	}

	/**
	 * @param \DateTime $startTime
	 */
	public function setStartTime(\DateTime $startTime = null)
	{
		$this->startTime = $startTime;
	}

	/**
	 * @return \DateTime|false
	 */
	public function getEndTime()
	{
		return $this->endTime;
	}

	/**
	 * @param \DateTime $endTime
	 */
	public function setEndTime(\DateTime $endTime = null)
	{
		$this->endTime = $endTime;
	}

	/**
	 * @return \DateTime|false
	 */
	public function getAccessEndTime()
	{
		return $this->accessEndTime;
	}

	/**
	 * @param \DateTime $endTime
	 */
	public function setAccessEndTime(\DateTime $endTime = null)
	{
		$this->accessEndTime = $endTime;
	}

	/**
	 * @return Venue|null
	 */
	public function getVenue()
	{
		return $this->venue;
	}

	/**
	 * @param Venue $venue
	 */
	public function setVenue(Venue $venue)
	{
		$this->venue = $venue;
	}

	/**
	 * @return Attraction|null
	 */
	public function getAttraction()
	{
		return $this->attraction;
	}

	/**
	 * @param Attraction $attraction
	 */
	public function setAttraction(Attraction $attraction)
	{
		$this->attraction = $attraction;
	}

	/**
	 * @return Status|null
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param Status $status
	 */
	public function setStatus(Status $status = null)
	{
		$this->status = $status;
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

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl(string $url): void
	{
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getShopUrl(): string
	{
		return $this->shopUrl;
	}

	/**
	 * @param string $shopUrl
	 */
	public function setShopUrl(string $shopUrl): void
	{
		$this->shopUrl = $shopUrl;
	}

	/**
	 * @return string
	 */
	public function getAccessDuration(): string
	{
		return $this->accessDuration;
	}

	/**
	 * @param string $accessDuration
	 */
	public function setAccessDuration(string $accessDuration): void
	{
		$this->accessDuration = $accessDuration;
	}

	/**
	 * @return bool
	 */
	public function isFreeAccessToPacks(): bool
	{
		return $this->freeAccessToPacks;
	}

	/**
	 * @param bool $freeAccessToPacks
	 */
	public function setFreeAccessToPacks(bool $freeAccessToPacks): void
	{
		$this->freeAccessToPacks = $freeAccessToPacks;
	}

	/**
	 * @return bool
	 */
	public function isFreeAccessToSeats(): bool
	{
		return $this->freeAccessToSeats;
	}

	/**
	 * @param bool $freeAccessToSeats
	 */
	public function setFreeAccessToSeats(bool $freeAccessToSeats): void
	{
		$this->freeAccessToSeats = $freeAccessToSeats;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

}