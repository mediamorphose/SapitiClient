<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;

class Attraction extends ApiObject
{

	protected $description='';
	protected $categories=[];
	protected $imageURL='';
	protected $smallImageURL='';

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Attraction|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Attraction $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['description'])) $result->setDescription($data['description']);
		if(isset($data['imageurl'])) $result->setImageURL($data['imageurl']);
		if(isset($data['imageurl_small'])) $result->setSmallImageURL($data['imageurl_small']);
		if(isset($data['categories']))
			$result->setCategories(Category::getMultipleFromArray($data['categories']));

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
	public function setDescription(string $description)
	{
		$this->description = $description;
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
	public function setCategories(array $categories)
	{
		$this->categories = $categories;
	}

	/**
	 * @return string
	 */
	public function getImageURL(): string
	{
		return $this->imageURL;
	}

	/**
	 * @param string $imageURL
	 */
	public function setImageURL(string $imageURL)
	{
		$this->imageURL = $imageURL;
	}

	/**
	 * @return string
	 */
	public function getSmallImageURL(): string
	{
		return $this->smallImageURL;
	}

	/**
	 * @param string $smallImageURL
	 */
	public function setSmallImageURL(string $smallImageURL)
	{
		$this->smallImageURL = $smallImageURL;
	}





}