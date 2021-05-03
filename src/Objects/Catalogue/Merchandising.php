<?php


namespace Sapiti\Objects\Catalogue;


use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\ApiObject;

class Merchandising extends ApiObject
{

	protected $description = '';
	protected $shopUrl = '';
	protected $imageUrl = '';
	protected $categories=[];
	protected $metaData=[];
	protected $barCode = null;

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Merchandising|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Merchandising $result */
		$result = parent::getFromArray($data, $existingObject);

		if (isset($data['label'])) $result->setLabel($data['label']);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['image_url'])) $result->setImageUrl($data['image_url']);
		if (isset($data['shop_url'])) $result->setShopUrl($data['shop_url']);

		if(isset($data['categories']))
			$result->setCategories(Category::getMultipleFromArray($data['categories']));

		if(isset($data['metadata']) && is_array($data['metadata']))
			$result->setMetaData($data['metadata']);

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
	public function getCategories(): array
	{
		return $this->categories;
	}

	/**
	 * @param array $categories
	 */
	public function setCategories(array $categories): void
	{
		$this->categories = $categories;
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
	 * @return null
	 */
	public function getBarCode()
	{
		return $this->barCode;
	}

	/**
	 * @param null $barCode
	 */
	public function setBarCode($barCode): void
	{
		$this->barCode = $barCode;
	}




}