<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class Price extends ApiObject
{

	protected $description='';
	protected $amount=-1;
	protected $currency='EUR';
	protected $quantityMin=-1;
	protected $quantityMax=-1;

	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Price $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['quantity_min'])) $result->setQuantityMin($data['quantity_min']);
		if (isset($data['quantity_max'])) $result->setQuantityMax($data['quantity_max']);
		if (isset($data['value']['amount'])) $result->setAmount($data['value']['amount']);
		if (isset($data['value']['currency'])) $result->setCurrency($data['value']['currency']);
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
	 * @return int
	 */
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(int $amount): void
	{
		$this->amount = $amount;
	}

	/**
	 * @return string
	 */
	public function getCurrency(): string
	{
		return $this->currency;
	}

	/**
	 * @param string $currency
	 */
	public function setCurrency(string $currency): void
	{
		$this->currency = $currency;
	}

	/**
	 * @return int
	 */
	public function getQuantityMin(): int
	{
		return $this->quantityMin;
	}

	/**
	 * @param int $quantityMin
	 */
	public function setQuantityMin(int $quantityMin): void
	{
		$this->quantityMin = $quantityMin;
	}

	/**
	 * @return int
	 */
	public function getQuantityMax(): int
	{
		return $this->quantityMax;
	}

	/**
	 * @param int $quantityMax
	 */
	public function setQuantityMax(int $quantityMax): void
	{
		$this->quantityMax = $quantityMax;
	}





}