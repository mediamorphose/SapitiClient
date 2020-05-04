<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;

class Venue extends ApiObject
{

	protected $addressL1='';
	protected $addressL2='';
	protected $addressPostalCode='';
	protected $addressCity='';
	protected $addressCountry='';
	protected $mapURL='';


	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Venue|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Venue $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['addressl1'])) $result->setAddressL1($data['addressl1']);
		if(isset($data['address2'])) $result->setAddressL2($data['address2']);
		if(isset($data['postalcode'])) $result->setAddressPostalCode($data['postalcode']);
		if(isset($data['city'])) $result->setAddressCity($data['city']);
		if(isset($data['country'])) $result->setAddressCountry($data['country']);
		if(isset($data['mapurl'])) $result->setMapURL($data['mapurl']);
		return $result;
	}

	/**
	 * @return string
	 */
	public function getAddressL1(): string
	{
		return $this->addressL1;
	}

	/**
	 * @param string $addressL1
	 */
	public function setAddressL1(string $addressL1)
	{
		$this->addressL1 = $addressL1;
	}

	/**
	 * @return string
	 */
	public function getAddressL2(): string
	{
		return $this->addressL2;
	}

	/**
	 * @param string $addressL2
	 */
	public function setAddressL2(string $addressL2)
	{
		$this->addressL2 = $addressL2;
	}

	/**
	 * @return string
	 */
	public function getAddressPostalCode(): string
	{
		return $this->addressPostalCode;
	}

	/**
	 * @param string $addressPostalCode
	 */
	public function setAddressPostalCode(string $addressPostalCode)
	{
		$this->addressPostalCode = $addressPostalCode;
	}

	/**
	 * @return string
	 */
	public function getAddressCity(): string
	{
		return $this->addressCity;
	}

	/**
	 * @param string $addressCity
	 */
	public function setAddressCity(string $addressCity)
	{
		$this->addressCity = $addressCity;
	}

	/**
	 * @return string
	 */
	public function getAddressCountry(): string
	{
		return $this->addressCountry;
	}

	/**
	 * @param string $addressCountry
	 */
	public function setAddressCountry(string $addressCountry)
	{
		$this->addressCountry = $addressCountry;
	}

	/**
	 * @return string
	 */
	public function getMapURL(): string
	{
		return $this->mapURL;
	}

	/**
	 * @param string $mapURL
	 */
	public function setMapURL(string $mapURL)
	{
		$this->mapURL = $mapURL;
	}


}