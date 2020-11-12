<?php


namespace Sapiti\Objects\Streaming;


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

	/** @var Client|null  */
	protected $client = null;

	/** @var Status|null  */
	protected $status =null;


	/** @var Venue  */
	protected $venue=null;

	/** @var Attraction  */
	protected $attraction=null;

	protected $url='';

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Stream|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Stream $result */
		$result = parent::getFromArray($data, $existingObject);

		if(isset($data['url'])) $result->setUrl($data['url']);
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
		if(isset($data['client']))
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







}