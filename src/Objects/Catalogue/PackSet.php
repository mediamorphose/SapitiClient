<?php


namespace Sapiti\Objects\Catalogue;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Shop\Stock;


class PackSet extends ApiObject
{

	protected $description = '';
	protected $itemNb_min = 0;
	protected $itemNb_max = 0;

    protected $stocks=[];

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return PackSet|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var PackSet $result */
		$result = parent::getFromArray($data, $existingObject);

		if (isset($data['label'])) $result->setLabel($data['label']);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['itemnb_max'])) $result->setItemNbMax($data['itemnb_max']);
		if (isset($data['itemnb_min'])) $result->setItemNbMin($data['itemnb_min']);

        if (isset($data['stocks'])) {
            $result->setStocks(Stock::getMultipleFromArray($data['stocks']));
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
     * @return int
     */
    public function getItemNbMin(): int
    {
        return $this->itemNb_min;
    }

    /**
     * @param int $itemNb_min
     */
    public function setItemNbMin(int $itemNb_min): void
    {
        $this->itemNb_min = $itemNb_min;
    }

    /**
     * @return int
     */
    public function getItemNbMax(): int
    {
        return $this->itemNb_max;
    }

    /**
     * @param int $itemNb_max
     */
    public function setItemNbMax(int $itemNb_max): void
    {
        $this->itemNb_max = $itemNb_max;
    }

    /**
     * @return array
     */
    public function getStocks(): array
    {
        return $this->stocks;
    }

    /**
     * @param array $stocks
     */
    public function setStocks(array $stocks): void
    {
        $this->stocks = $stocks;
    }



}