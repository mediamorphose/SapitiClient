<?php


namespace Sapiti\Objects;


use phpDocumentor\Reflection\Types\Array_;
use Sapiti\Objects\Business\Client;

class ApiObject
{
	protected $id='';
	protected $label='';

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return ApiObject|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		if (!$data || sizeof($data)==0) return null;
		if (!$existingObject) $existingObject=new static();

		if(isset($data['id']))$existingObject->setId($data['id']);
		if(isset($data['label']))$existingObject->setLabel($data['label']);

		return $existingObject;
	}

	static function toArray(ApiObject $existingObject) {
		$data=[];
		$data['id']=$existingObject->getId();
		$data['label']=$existingObject->getLabel();
		return $data;
	}

	static function getMultipleFromArray($data = null) {
		$result= [];

		foreach($data as $dataItem) {
			$result[] = static::getFromArray($dataItem);
		}

		return $result;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId(string $id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getLabel(): string
	{
		return $this->label;
	}

	/**
	 * @param string $label
	 */
	public function setLabel(string $label)
	{
		$this->label = $label;
	}



}