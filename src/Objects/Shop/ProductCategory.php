<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class ProductCategory extends ApiObject
{
	use TCapacity;

	protected $description='';
    protected $color='';
	protected $prices=[];



	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var ProductCategory $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['description'])) $result->setDescription($data['description']);
        if (isset($data['color'])) $result->setColor($data['color']);
		if (isset($data['capacity_total'])) $result->setCapacityTotal($data['capacity_total']);
		if (isset($data['capacity_free'])) $result->setCapacityFree($data['capacity_free']);

		if (isset($data['prices'])) {
			$result->setPrices(Price::getMultipleFromArray($data['prices']));
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
	 * @return array
	 */
	public function getPrices(): array
	{
		return $this->prices;
	}

	/**
	 * @param array $prices
	 */
	public function setPrices(array $prices): void
	{
		$this->prices = $prices;
	}

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }




}