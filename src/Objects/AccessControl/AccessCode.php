<?php


namespace Sapiti\Objects\AccessControl;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TUsage;

class AccessCode extends ApiObject
{
	use TUsage;

	//code ok
	const STATUS_OK=1;

	//to be managed by the operator
	const STATUS_CHECKPRICECATEGORY_ID=-100;
	const STATUS_CHECKSECTION_ID=-101;
	const STATUS_CREATE_ORDER_ID=-102;

	//errors
	const STATUS_PENDING_PAYMENT_ID=-200;
	const STATUS_WRONG_EVENT_ID=-201;
	const STATUS_ALLREADY_USED_ID=-202;
	const STATUS_SOLDOUT_ID=-203;
	const STATUS_NOT_ALLOWED_ID=-250;
	const STATUS_UNKNOWN_ID=-299;

	protected $origin='';
	protected $productId=null;
	protected $ticket=null;


	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var AccessCode $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['code'])) $result->setLabel($data['code']);
		if(isset($data['origin'])) $result->setOrigin($data['origin']);
		if(isset($data['productid'])) $result->setProductId($data['productid']);
		if (isset($data['usage'])) {
			if (isset($data['usage']['statusid'])) $result->setUsageId($data['usage']['statusid']);
			if (isset($data['usage']['by'])) $result->setUsageLabel($data['usage']['by']);
			if (isset($data['usage']['date'])) {
				$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['usage']['date']);
				$result->setUsageDate($date);
			}
		}

		return $result;
	}


	public function getCode() {
		return $this->getLabel();
	}

	/**
	 * @return null
	 */
	public function getProductId()
	{
		return $this->productId;
	}

	/**
	 * @param null $productId
	 */
	public function setProductId($productId): void
	{
		$this->productId = $productId;
	}



	/**
	 * @return string
	 */
	public function getOrigin(): string
	{
		return $this->origin;
	}

	/**
	 * @param string $origin
	 */
	public function setOrigin(string $origin): void
	{
		$this->origin = $origin;
	}

	/**
	 * @return int
	 */
	public function getStatusId(): int
	{
		return $this->getUsageId();
	}

}