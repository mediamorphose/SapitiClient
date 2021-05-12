<?php


namespace Sapiti\Objects\Shop;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Status;

class PaymentMethod extends ApiObject
{

	const TYPE_UNKNOWN=-1;
	const TYPE_CASH=1;
	const TYPE_BANKTRANSFER=2;
	const TYPE_ONLINE=3;
	const TYPE_INVOICE=4;
	const TYPE_CLIENTACCOUNT=5;

	protected $typeId = '';

	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var PaymentMethod $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);
		return $result;
	}

	static function toArray(ApiObject $existingObject) {
		/** @var PaymentMethod $existingObject */
		$data=parent::toArray($existingObject);;
		$data['typeid']=$existingObject->getTypeId();
		return $data;
	}

	/**
	 * @return string
	 */
	public function getTypeId(): string
	{
		return $this->typeId;
	}

	/**
	 * @param string $typeId
	 */
	public function setTypeId(string $typeId): void
	{
		$this->typeId = $typeId;
	}






}