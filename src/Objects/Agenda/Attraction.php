<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;

class Attraction extends ApiObject
{

	protected $description='';
	protected $categories=[];
	protected $imageURL='';
	protected $smallImageURL='';

	protected $firstEvent_date = null;
	protected $lastEvent_date = null;
	protected $nbEvents = 0;

	protected $externalId = null;

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Attraction|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Attraction $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['description'])) $result->setDescription($data['description']);
		if(isset($data['externalid'])) $result->setExternalId($data['externalid']);
		if(isset($data['image_url'])) $result->setImageURL($data['image_url']);
		if(isset($data['image_url_small'])) $result->setSmallImageURL($data['image_url_small']);
		if(isset($data['categories']))
			$result->setCategories(Category::getMultipleFromArray($data['categories']));

		if(isset($data['firstevent_date']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['firstevent_date']);
			$result->setFirstEventDate($date);
		}

		if(isset($data['lastevent_date']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['lastevent_date']);
			$result->setLastEventDate($date);
		}
		if(isset($data['nb_events'])) $result->setNbEvents($data['nb_events']);

		return $result;
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
	public function setDescription(string $description)
	{
		$this->description = $description;
	}

	/**
	 * @return array
	 */
	public function getCategories(): array
	{
		return $this->categories;
	}

	/**
	 * @param array $categories
	 */
	public function setCategories(array $categories)
	{
		$this->categories = $categories;
	}

	/**
	 * @return string
	 */
	public function getImageURL(): string
	{
		return $this->imageURL;
	}

	/**
	 * @param string $imageURL
	 */
	public function setImageURL(string $imageURL)
	{
		$this->imageURL = $imageURL;
	}

	/**
	 * @return string
	 */
	public function getSmallImageURL(): string
	{
		return $this->smallImageURL;
	}

	/**
	 * @param string $smallImageURL
	 */
	public function setSmallImageURL(string $smallImageURL)
	{
		$this->smallImageURL = $smallImageURL;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getFirstEventDate()
	{
		return $this->firstEvent_date;
	}

	/**
	 * @param \DateTime|null $endTime
	 */
	public function setFirstEventDate(\DateTime $endTime=null)
	{
		$this->firstEvent_date = $endTime;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastEventDate()
	{
		return $this->lastEvent_date;
	}

	/**
	 * @param \DateTime|null $endTime
	 */
	public function setLastEventDate (\DateTime $endTime=null)
	{
		$this->lastEvent_date = $endTime;
	}

	/**
	 * @return int
	 */
	public function getNbEvents(): int
	{
		return $this->nbEvents;
	}

	/**
	 * @param int $nbEvents
	 */
	public function setNbEvents(int $nbEvents): void
	{
		$this->nbEvents = $nbEvents;
	}

	/**
	 * @return null
	 */
	public function getExternalId()
	{
		return $this->externalId;
	}

	/**
	 * @param null $externalId
	 */
	public function setExternalId($externalId): void
	{
		$this->externalId = $externalId;
	}








}