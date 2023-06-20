<?php


namespace Sapiti\Objects\Contact;


use Sapiti\Objects\ApiObject;

class Contact extends ApiObject
{

	protected $firstName='';
	protected $lastName='';
	protected $email='';
    protected $language='';
	protected $mobilePhone='';
	protected $addressL1='';
	protected $addressL2='';
	protected $addressPostalCode='';
	protected $addressCity='';
	protected $addressCountry='';
    protected $companyName='';
    protected $companyFunction='';


	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Contact $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['firstname'])) $result->setFirstName($data['firstname']);
		if(isset($data['lastname'])) $result->setLastName($data['lastname']);
		if(isset($data['email'])) $result->setEmail($data['email']);
        if(isset($data['language'])) $result->setLanguage($data['language']);
		if(isset($data['mobilephone'])) $result->setMobilePhone($data['mobilephone']);
		if(isset($data['addressl1'])) $result->setAddressL1($data['addressl1']);
		if(isset($data['addressl2'])) $result->setAddressL2($data['addressl2']);
		if(isset($data['postalcode'])) $result->setAddressPostalCode($data['postalcode']);
		if(isset($data['city'])) $result->setAddressCity($data['city']);
		if(isset($data['country'])) $result->setAddressCountry($data['country']);
        if(isset($data['companyfunction'])) $result->setCompanyFunction($data['companyfunction']);
        if(isset($data['companyname'])) $result->setCompanyName($data['companyname']);
		return $result;
	}

	static function toArray(ApiObject $existingObject) {
		/** @var Contact $existingObject */
		$data = parent::toArray($existingObject);
		$data['firstname']=$existingObject->getFirstName();
		$data['lastname']=$existingObject->getLastName();
		$data['email']=$existingObject->getEmail();
        $data['language']=$existingObject->getLanguage();
		$data['mobilephone']=$existingObject->getMobilePhone();
		$data['addressl1']=$existingObject->getAddressL1();
		$data['addressl2']=$existingObject->getAddressL2();
		$data['postalcode']=$existingObject->getAddressPostalCode();
		$data['city']=$existingObject->getAddressCity();
		$data['country']=$existingObject->getAddressCountry();
        $data['companyfunction']=$existingObject->getCompanyFunction();
        $data['companyname']=$existingObject->getCompanyName();
		return $data;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string
	{
		return $this->firstName;
	}

	/**
	 * @param ?string $firstName
	 */
	public function setFirstName(?string $firstName): void
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->lastName;
	}

	/**
	 * @param ?string $lastName
	 */
	public function setLastName(?string $lastName): void
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param ?string $email
	 */
	public function setEmail(?string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getAddressL1(): string
	{
		return $this->addressL1;
	}

	/**
	 * @param ?string $addressL1
	 */
	public function setAddressL1(?string $addressL1): void
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
	 * @param ?string $addressL2
	 */
	public function setAddressL2(?string $addressL2): void
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
	 * @param ?string $addressPostalCode
	 */
	public function setAddressPostalCode(?string $addressPostalCode): void
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
	 * @param ?string $addressCity
	 */
	public function setAddressCity(?string $addressCity): void
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
	 * @param ?string $addressCountry
	 */
	public function setAddressCountry(?string $addressCountry): void
	{
		$this->addressCountry = $addressCountry;
	}

	/**
	 * @return string
	 */
	public function getMobilePhone(): string
	{
		return $this->mobilePhone;
	}

	/**
	 * @param ?string $mobilePhone
	 */
	public function setMobilePhone(?string $mobilePhone): void
	{
		$this->mobilePhone = $mobilePhone;
	}

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getCompanyFunction(): string
    {
        return $this->companyFunction;
    }

    /**
     * @param string $companyFunction
     */
    public function setCompanyFunction(string $companyFunction): void
    {
        $this->companyFunction = $companyFunction;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }







}