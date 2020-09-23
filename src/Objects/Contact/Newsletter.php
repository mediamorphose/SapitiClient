<?php
namespace Sapiti\Objects\Contact;


use Sapiti\Objects\ApiObject;

class Newsletter extends ApiObject
{

	protected $description='';
	protected $typeId=1;


	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Newsletter $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['typeid'])) $result->setTypeId($data['typeid']);
		if(isset($data['description'])) $result->setDescription($data['description']);
		return $result;
	}

	static function toArray(ApiObject $existingObject) {
		/** @var Newsletter $existingObject */
		$data = parent::toArray($existingObject);
		$data['typeid']=$existingObject->getTypeId();
		$data['description']=$existingObject->getDescription();
		return $data;
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

	

}