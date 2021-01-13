<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Client;
use Sapiti\Objects\Business\Status;

class Event extends ApiObject
{

	const STATUS_ARCHIVED = -99;
	const STATUS_CANCELLED = -10;
	const STATUS_OPTION = -5;
	const STATUS_CONFIRMED = -1;
	const STATUS_PUBLISHED = 10;
	const STATUS_PUBLISHEDNOBUTTON = 11;
	const STATUS_CANCELLEDANDPUBLISHED = 20;
	const STATUS_WAITINGLIST = 25;
	const STATUS_SOLDOUT = 30;
	const STATUS_ONSITEONLY = 35;
	const STATUS_ABOONLY = 40;

	protected $startTime = false;
	protected $endTime = false;

	/** @var Serie|null  */
	protected $serie = null;

	/** @var Status|null  */
	protected $status =null;


	/** @var Venue  */
	protected $venue=null;

	/** @var Attraction  */
	protected $attraction=null;

	protected $shopUrl='';

	protected $hasTimeSlots=false;

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Event|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Event $result */
		$result = parent::getFromArray($data, $existingObject);

		if(isset($data['serie'])) $result->setSerie(Serie::getFromArray($data['serie']));
		if(isset($data['shop_url'])) $result->setShopUrl($data['shop_url']);
		if(isset($data['hastimeslots'])) $result->setHasTimeSlots($data['hastimeslots']);
		if(isset($data['starttime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['starttime']);
			$result->setStartTime($date);
		}
		if(isset($data['endtime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['endtime']);
			$result->setEndTime($date);
		}

		if(isset($data['status'])) {
			$result->setStatus(Status::getFromArray($data['status']));
		}

		if(isset($data['venue']))
				$result->setVenue(Venue::getFromArray($data['venue']));
		if(isset($data['attraction']))
			$result->setAttraction(Attraction::getFromArray($data['attraction']));


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
	public function setStartTime(\DateTime $startTime=null)
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
	public function setEndTime(\DateTime $endTime=null)
	{
		$this->endTime = $endTime;
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
	public function setStatus(Status $status=null)
	{
		$this->status = $status;
	}

	/**
	 * @return Serie|null
	 */
	public function getSerie()
	{
		return $this->serie;
	}

	/**
	 * @param Serie|null $serie
	 */
	public function setSerie(Serie $serie)
	{
		$this->serie = $serie;
	}


	/**
	 * @return string
	 */
	public function getShopUrl(): string
	{
		return $this->shopUrl;
	}

	/**
	 * @param string $shopurl
	 */
	public function setShopUrl(string $shopurl)
	{
		$this->shopUrl = $shopurl;
	}

	/**
	 * @return bool
	 */
	public function isHasTimeSlots(): bool
	{
		return $this->hasTimeSlots;
	}

	/**
	 * @param bool $hasTimeSlots
	 */
	public function setHasTimeSlots(bool $hasTimeSlots): void
	{
		$this->hasTimeSlots = $hasTimeSlots;
	}






}