<?php


namespace Sapiti\Objects\Shop;



use Sapiti\Objects\ApiObject;

class CounterSession extends ApiObject
{

	protected $startTime = null;
	protected $endTime = null;

	protected $startAmount=0;
	protected $endAmount=0;

	protected $notes='';
	protected $userLabel='';

	protected $counterId='';

	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var CounterSession $result */
		$result = parent::getFromArray($data, $existingObject);

		if(isset($data['counterid'])) $result->setCounterId($data['counterid']);

		if(isset($data['startamount'])) $result->setStartAmount($data['startamount']);
		if(isset($data['endamount'])) $result->setEndAmount($data['endamount']);
		if(isset($data['userlabel'])) $result->setUserLabel($data['userlabel']);
		if(isset($data['notes'])) $result->setNotes($data['notes']);
		if(isset($data['starttime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['starttime']);
			$result->setStartTime($date);
		}
		if(isset($data['endtime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['endtime']);
			$result->setEndTime($date);
		}

		return $result;
	}

	static function toArray(ApiObject $existingObject) {
		/** @var CounterSession $existingObject */
		$data = parent::toArray($existingObject);
		$data['counterid']=$existingObject->getCounterId();
		$data['startamount']=$existingObject->getStartAmount();
		$data['endamount']=$existingObject->getEndAmount();
		$data['userlabel']=$existingObject->getUserLabel();
		$data['notes']=$existingObject->getNotes();
		$data['starttime']=null;
		$data['endtime']=null;

		if($existingObject->getStartTime())
			$data['starttime']=$existingObject->getStartTime()->format('c');
		if($existingObject->getEndTime())
			$data['endtime']=$existingObject->getEndTime()->format('c');

		return $data;
	}



	/**
	 * @return \DateTime|null
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
	 * @return \DateTime|null
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
	 * @return string
	 */
	public function getCounterId(): string
	{
		return $this->counterId;
	}

	/**
	 * @param string $counterId
	 */
	public function setCounterId(string $counterId)
	{
		$this->counterId = $counterId;
	}


	/**
	 * @return int
	 */
	public function getStartAmount(): int
	{
		return $this->startAmount;
	}

	/**
	 * @param int $startAmount
	 */
	public function setStartAmount(int $startAmount)
	{
		$this->startAmount = $startAmount;
	}

	/**
	 * @return int
	 */
	public function getEndAmount(): int
	{
		return $this->endAmount;
	}

	/**
	 * @param int $endAmount
	 */
	public function setEndAmount(int $endAmount)
	{
		$this->endAmount = $endAmount;
	}

	/**
	 * @return string
	 */
	public function getNotes()
	{
		return $this->notes;
	}

	/**
	 * @param string $notes
	 */
	public function setNotes( $notes)
	{
		$this->notes = $notes;
	}

	/**
	 * @return string
	 */
	public function getUserLabel()
	{
		return $this->userLabel;
	}

	/**
	 * @param string $userLabel
	 */
	public function setUserLabel($userLabel)
	{
		$this->userLabel = $userLabel;
	}







}