<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class Stock extends ApiObject
{
	use TCapacity;

	protected $shopUrl='';
	protected $typeId=1;
	protected $eventId='';
	protected $timeSlotId='';
	protected $productCategories=[];

	protected $hasPromoCodes=false;

	protected $notes = '';

	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Stock $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);
		if (isset($data['eventid'])) $result->setEventId($data['eventid']);
		if (isset($data['timeslotid'])) $result->setTimeSlotId($data['timeslotid']);
		if (isset($data['capacity_total'])) $result->setCapacityTotal($data['capacity_total']);
		if (isset($data['capacity_free'])) $result->setCapacityFree($data['capacity_free']);
		if (isset($data['shop_url'])) $result->setShopUrl($data['shop_url']);
		if (isset($data['haspromocodes'])) $result->setHasPromoCodes($data['haspromocodes']);
		if (isset($data['notes'])) $result->setNotes($data['notes']);
		if (isset($data['categories'])) {
			$result->setProductCategories(ProductCategory::getMultipleFromArray($data['categories']));
		}

		return $result;
	}

	/**
	 * @return string
	 */
	public function getShopUrl(): string
	{
		return $this->shopUrl;
	}

	/**
	 * @param string $shopUrl
	 */
	public function setShopUrl(string $shopUrl): void
	{
		$this->shopUrl = $shopUrl;
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

	/**
	 * @return array
	 */
	public function getProductCategories(): array
	{
		return $this->productCategories;
	}

	/**
	 * @param array $productCategories
	 */
	public function setProductCategories(array $productCategories): void
	{
		$this->productCategories = $productCategories;
	}

	/**
	 * @return bool
	 */
	public function isHasPromoCodes(): bool
	{
		return $this->hasPromoCodes;
	}

	/**
	 * @param bool $hasPromoCodes
	 */
	public function setHasPromoCodes(bool $hasPromoCodes): void
	{
		$this->hasPromoCodes = $hasPromoCodes;
	}

	/**
	 * @return string
	 */
	public function getTimeSlotId(): string
	{
		return $this->timeSlotId;
	}

	/**
	 * @param string $timeSlotId
	 */
	public function setTimeSlotId(string $timeSlotId): void
	{
		$this->timeSlotId = $timeSlotId;
	}




	/**
	 * @return string
	 */
	public function getNotes(): string
	{
		return $this->notes;
	}/**
 * @param string $notes
 */
	public function setNotes(string $notes): void
	{
		$this->notes = $notes;
	}






}