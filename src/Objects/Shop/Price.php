<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class Price extends ApiObject
{

	protected $description='';
	protected $price=-1;

	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Price $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['price'])) $result->setPrice($data['price']);
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
	public function getPrice(): int
	{
		return $this->price;
	}

	/**
	 * @param int $price
	 */
	public function setPrice(int $price): void
	{
		$this->price = $price;
	}



}