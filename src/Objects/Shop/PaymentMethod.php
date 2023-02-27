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

    protected $metaData=[];

	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var PaymentMethod $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);
        if(isset($data['metadata']) && is_array($data['metadata']))
            $result->setMetaData($data['metadata']);

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

    /**
     * @return array
     */
    public function getMetaData()
    {
        if(!is_array($this->metaData))
            $this->metaData=[];
        return $this->metaData;
    }

    /**
     * @param array $metaData
     */
    public function setMetaData($metaData): void
    {
        $this->metaData = $metaData;
    }





}