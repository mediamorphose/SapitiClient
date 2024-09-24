<?php


namespace Sapiti\Objects\Catalogue;

use Sapiti\Objects\ApiObject;


class Pack extends ApiObject
{

	protected $description = '';
	protected $shopUrl = '';
	protected $mainPackId = '';
	protected $itemNb_min = 0;
	protected $itemNb_max = 0;
	protected $imageUrl = '';
	protected $metaData=[];

    protected $sets=[];

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Pack|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Pack $result */
		$result = parent::getFromArray($data, $existingObject);

		if (isset($data['label'])) $result->setLabel($data['label']);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['mainpackid'])) $result->setMainPackId($data['mainpackid']);
		if (isset($data['itemnb_max'])) $result->setItemNbMax($data['itemnb_max']);
		if (isset($data['itemnb_min'])) $result->setItemNbMin($data['itemnb_min']);

		if (isset($data['image_url'])) $result->setImageUrl($data['image_url']);
        if (isset($data['shop_url'])) $result->setShopUrl($data['shop_url']);

		if(isset($data['metadata']) && is_array($data['metadata']))
			$result->setMetaData($data['metadata']);


        if (isset($data['sets'])) {
            $result->setSets(PackSet::getMultipleFromArray($data['sets']));
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
	 * @return string
	 */
	public function getMainPackId(): string
	{
		return $this->mainPackId;
	}

	/**
	 * @param string $mainPackId
	 */
	public function setMainPackId(string $mainPackId): void
	{
		$this->mainPackId = $mainPackId;
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
	 * @return string
	 */
	public function getImageUrl(): string
	{
		return $this->imageUrl;
	}

	/**
	 * @param string $imageUrl
	 */
	public function setImageUrl(string $imageUrl): void
	{
		$this->imageUrl = $imageUrl;
	}

	/**
	 * @return array
	 */
	public function getMetaData(): array
	{
		return $this->metaData;
	}

	/**
	 * @param array $metaData
	 */
	public function setMetaData(array $metaData): void
	{
		$this->metaData = $metaData;
	}

    /**
     * @return array
     */
    public function getSets(): array
    {
        return $this->sets;
    }

    /**
     * @param array $sets
     */
    public function setSets(array $sets): void
    {
        $this->sets = $sets;
    }




}