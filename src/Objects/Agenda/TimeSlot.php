<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;

class TimeSlot extends ApiObject
{

	protected $startTime = false;
	protected $eventId = '';
	protected $capacity=0;

	
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var TimeSlot $result */
		$result = parent::getFromArray($data, $existingObject);

		if(isset($data['capacity'])) $result->setCapacity($data['capacity']);
		if(isset($data['eventid'])) $result->setEventId($data['eventid']);
		if(isset($data['starttime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['starttime']);
			$result->setStartTime($date);
		}

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
	 * @return int
	 */
	public function getCapacity(): int
	{
		return $this->capacity;
	}

	/**
	 * @param int $capacity
	 */
	public function setCapacity(int $capacity): void
	{
		$this->capacity = $capacity;
	}

	/**
	 * @return string
	 */
	public function getEventId(): string
	{
		return $this->eventId;
	}

	/**
	 * @param string $eventId
	 */
	public function setEventId(string $eventId): void
	{
		$this->eventId = $eventId;
	}






}