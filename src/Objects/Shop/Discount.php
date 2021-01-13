<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;

class Discount extends ApiObject
{
	protected $value='';
	protected $percentage='';

	/**
	 * @param null $data
	 * @param Discount|null $existingObject
	 * @return Discount|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		$result=parent::getFromArray($data,$existingObject);
		if(isset($data['value']))$result->setValue($data['value']);
		if(isset($data['percentage']))$result->setPercentage($data['percentage']);
		return $result;
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue(string $value): void
	{
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getPercentage(): string
	{
		return $this->percentage;
	}

	/**
	 * @param string $percentage
	 */
	public function setPercentage(string $percentage): void
	{
		$this->percentage = $percentage;
	}






}