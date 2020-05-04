<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;

class Category extends ApiObject
{
	protected $description='';

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Category|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Category $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['description'])) $result->setDescription($data['description']);
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




}