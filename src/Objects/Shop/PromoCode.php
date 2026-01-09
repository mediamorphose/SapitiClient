<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class PromoCode extends ApiObject
{
	use TCapacity;

	const TYPE_DISCOUNT = 100;
	const TYPE_RELEAVE = 300;

	protected $description = '';
    protected $message = '';
	protected $startTime = false;
	protected $endTime = false;
	protected $typeId = 100;
	protected $discount = null;
	protected $productCategory = null;


	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var PromoCode $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['description'])) $result->setDescription($data['description']);
        if (isset($data['message'])) $result->setMessage($data['message']);
		if(isset($data['starttime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['starttime']);
			$result->setStartTime($date);
		}
		if(isset($data['endtime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['endtime']);
			$result->setEndTime($date);
		}
		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);
		if (isset($data['capacity_total'])) $result->setCapacityTotal($data['capacity_total']);
		if (isset($data['capacity_free'])) $result->setCapacityFree($data['capacity_free']);

		if (isset($data['discount'])) {
			$result->setDiscount(Discount::getFromArray($data['discount']));
		}

		if (isset($data['product_category'])) {
			$result->setProductCategory(ProductCategory::getFromArray($data['product_category']));
		}
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
	public function setDescription(string $description): void
	{
		$this->description = $description;
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
	 * @return int
	 */
	public function getTypeId(): int
	{
		return $this->typeId;
	}

	/**
	 * @param int $typeId
	 */
	public function setTypeId(int $typeId): void
	{
		$this->typeId = $typeId;
	}

	/**
	 * @return null
	 */
	public function getDiscount()
	{
		return $this->discount;
	}

	/**
	 * @param null $discount
	 */
	public function setDiscount($discount): void
	{
		$this->discount = $discount;
	}

	/**
	 * @return null
	 */
	public function getProductCategory()
	{
		return $this->productCategory;
	}

	/**
	 * @param null $productCategory
	 */
	public function setProductCategory($productCategory): void
	{
		$this->productCategory = $productCategory;
	}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }




}