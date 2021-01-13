<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class TimeSlot extends ApiObject
{

	protected $startTime = false;
	protected $eventId = '';
	protected $capacity=0;

	
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var TimeSlot $result */
		$result = parent::getFromArray($data, $existingObject);

		if(isset($data['capacity'])) $result->setCapacity($data['capacity']);
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
	 * @return string
	 */
	public function getTimeSlotId(): string
	{
		return $this->eventId;
	}

	/**
	 * @param string $eventId
	 */
	public function setTimeSlotId(string $eventId): void
	{
		$this->eventId = $eventId;
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





}