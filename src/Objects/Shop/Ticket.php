<?php


namespace Sapiti\Objects\Shop;

use DateTimeInterface;
use Sapiti\Objects\ApiObject;

class Ticket extends ApiObject
{

	protected $spectatorLabel='';
    protected $spectatorFirstName='';
    protected $spectatorLastName='';
    protected $spectatorEmail='';
    protected $spectatorId='';
	protected $positionLabel='';
	protected $categoryLabel='';
	protected $entryCount=1;
	protected $pricelabel='';
	protected $orderreference='';
    protected $orderDate=null;
	protected $qrcode='';

	protected $language='fr';
	protected $attractionLabel='';
	protected $presentingLabel='';
	protected $notes='';
	protected $startTime = null;
	protected $endTime = null;

	protected $venueLabel='';
	protected $venueAddressL1='';
	protected $venueAddressL2='';

	protected $price = null;

	protected $typeId= '';
	protected $validityDate = null;

	protected $metaData=[];



	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Ticket $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['spectatorlabel'])) $result->setSpectatorLabel($data['spectatorlabel']);
        if (isset($data['spectatorfirstname'])) $result->setSpectatorFirstName($data['spectatorfirstname']);
        if (isset($data['spectatorlastname'])) $result->setSpectatorLastName($data['spectatorlastname']);
        if (isset($data['spectatoremail'])) $result->setSpectatorEmail($data['spectatoremail']);
        if (isset($data['spectatorid'])) $result->setSpectatorId($data['spectatorid']);
		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);
		if (isset($data['positionlabel'])) $result->setPositionLabel($data['positionlabel']);
		if (isset($data['categorylabel'])) $result->setCategoryLabel($data['categorylabel']);
		if (isset($data['entrycount'])) $result->setEntryCount($data['entrycount']);
		if (isset($data['pricelabel'])) $result->setPricelabel($data['pricelabel']);
        if (isset($data['price'])) $result->setPrice($data['price']);
		if (isset($data['orderreference'])) $result->setOrderreference($data['orderreference']);
		if (isset($data['qrcode'])) $result->setQrcode($data['qrcode']);

		if (isset($data['attractionlabel'])) $result->setAttractionLabel($data['attractionlabel']);
		if(isset($data['eventstarttime']))  {
			$date = \DateTime::createFromFormat(DateTimeInterface::ATOM, $data['eventstarttime']);
			$result->setStartTime($date);
		}
		if(isset($data['eventendtime']))  {
			$date = \DateTime::createFromFormat(DateTimeInterface::ATOM, $data['eventendtime']);
			$result->setEndTime($date);
		}
		if(isset($data['validitydate']))  {
			$date = \DateTime::createFromFormat(DateTimeInterface::ATOM, $data['validitydate']);
			$result->setValidityDate($date);
		}
        if(isset($data['orderdate']))  {
            $date = \DateTime::createFromFormat(DateTimeInterface::ATOM, $data['orderdate']);
            $result->setOrderDate($date);
        }
		if (isset($data['presentinglabel'])) $result->setPresentingLabel($data['presentinglabel']);
		if (isset($data['notes'])) $result->setNotes($data['notes']);
		if (isset($data['venuelabel'])) $result->setVenueLabel($data['venuelabel']);
		if (isset($data['venueaddressL1'])) $result->setVenueAddressL1($data['venueaddressL1']);
		if (isset($data['venueaddressL2'])) $result->setVenueAddressL2($data['venueaddressL2']);
		if (isset($data['metadata'])) $result->setMetaData($data['metadata']);

		return $result;
	}

	/**
	 * @return string
	 */
	public function getSpectatorLabel(): string
	{
		return $this->spectatorLabel;
	}

	/**
	 * @param string $spectatorLabel
	 */
	public function setSpectatorLabel(string $spectatorLabel): void
	{
		$this->spectatorLabel = $spectatorLabel;
	}

	/**
	 * @return string
	 */
	public function getPositionLabel(): string
	{
		return $this->positionLabel;
	}

	/**
	 * @param string $positionLabel
	 */
	public function setPositionLabel(string $positionLabel): void
	{
		$this->positionLabel = $positionLabel;
	}

	/**
	 * @return string
	 */
	public function getCategoryLabel(): string
	{
		return $this->categoryLabel;
	}

	/**
	 * @param string $categoryLabel
	 */
	public function setCategoryLabel(string $categoryLabel): void
	{
		$this->categoryLabel = $categoryLabel;
	}

	/**
	 * @return int
	 */
	public function getEntryCount(): int
	{
		return $this->entryCount;
	}

	/**
	 * @param int $entryCount
	 */
	public function setEntryCount(int $entryCount): void
	{
		$this->entryCount = $entryCount;
	}

	/**
	 * @return string
	 */
	public function getPricelabel(): string
	{
		return $this->pricelabel;
	}

	/**
	 * @param string $pricelabel
	 */
	public function setPricelabel(string $pricelabel): void
	{
		$this->pricelabel = $pricelabel;
	}

	/**
	 * @return string
	 */
	public function getOrderreference(): string
	{
		return $this->orderreference;
	}

	/**
	 * @param string $orderreference
	 */
	public function setOrderreference(string $orderreference): void
	{
		$this->orderreference = $orderreference;
	}

	/**
	 * @return string
	 */
	public function getQrcode(): string
	{
		return $this->qrcode;
	}

	/**
	 * @param string $qrcode
	 */
	public function setQrcode(string $qrcode): void
	{
		$this->qrcode = $qrcode;
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

	/**
	 * @return string
	 */
	public function getAttractionLabel(): string
	{
		return $this->attractionLabel;
	}

	/**
	 * @param string $attractionLabel
	 */
	public function setAttractionLabel(string $attractionLabel): void
	{
		$this->attractionLabel = $attractionLabel;
	}

	/**
	 * @return string
	 */
	public function getPresentingLabel(): string
	{
		return $this->presentingLabel;
	}

	/**
	 * @param string $presentingLabel
	 */
	public function setPresentingLabel(string $presentingLabel): void
	{
		$this->presentingLabel = $presentingLabel;
	}

	/**
	 * @return string
	 */
	public function getNotes(): string
	{
		return $this->notes;
	}

	/**
	 * @param string $notes
	 */
	public function setNotes(string $notes): void
	{
		$this->notes = $notes;
	}

	/**
	 * @return null
	 */
	public function getStartTime()
	{
		return $this->startTime;
	}

	/**
	 * @param null $startTime
	 */
	public function setStartTime($startTime): void
	{
		$this->startTime = $startTime;
	}

	/**
	 * @return null
	 */
	public function getEndTime()
	{
		return $this->endTime;
	}

	/**
	 * @param null $endTime
	 */
	public function setEndTime($endTime): void
	{
		$this->endTime = $endTime;
	}

	/**
	 * @return string
	 */
	public function getVenueLabel(): string
	{
		return $this->venueLabel;
	}

	/**
	 * @param string $venueLabel
	 */
	public function setVenueLabel(string $venueLabel): void
	{
		$this->venueLabel = $venueLabel;
	}

	/**
	 * @return string
	 */
	public function getVenueAddressL1(): string
	{
		return $this->venueAddressL1;
	}

	/**
	 * @param string $venueAddressL1
	 */
	public function setVenueAddressL1(string $venueAddressL1): void
	{
		$this->venueAddressL1 = $venueAddressL1;
	}

	/**
	 * @return string
	 */
	public function getVenueAddressL2(): string
	{
		return $this->venueAddressL2;
	}

	/**
	 * @param string $venueAddressL2
	 */
	public function setVenueAddressL2(string $venueAddressL2): void
	{
		$this->venueAddressL2 = $venueAddressL2;
	}

	/**
	 * @return null
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param null $price
	 */
	public function setPrice($price): void
	{
		$this->price = $price;
	}

	/**
	 * @return array
	 */
	public function getMetaData()
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
	 * @return string
	 */
	public function getTypeId(): string
	{
		return $this->typeId;
	}

	/**
	 * @param string $typeId
	 */
	public function setTypeId(string $typeId): void
	{
		$this->typeId = $typeId;
	}

	/**
	 * @return null
	 */
	public function getValidityDate()
	{
		return $this->validityDate;
	}

	/**
	 * @param null $validityDate
	 */
	public function setValidityDate($validityDate): void
	{
		$this->validityDate = $validityDate;
	}

    /**
     * @return string
     */
    public function getSpectatorFirstName(): string
    {
        return $this->spectatorFirstName;
    }

    /**
     * @param string $spectatorFirstName
     */
    public function setSpectatorFirstName(string $spectatorFirstName): void
    {
        $this->spectatorFirstName = $spectatorFirstName;
    }

    /**
     * @return string
     */
    public function getSpectatorLastName(): string
    {
        return $this->spectatorLastName;
    }

    /**
     * @param string $spectatorLastName
     */
    public function setSpectatorLastName(string $spectatorLastName): void
    {
        $this->spectatorLastName = $spectatorLastName;
    }

    /**
     * @return string
     */
    public function getSpectatorEmail(): string
    {
        return $this->spectatorEmail;
    }

    /**
     * @param string $spectatorEmail
     */
    public function setSpectatorEmail(string $spectatorEmail): void
    {
        $this->spectatorEmail = $spectatorEmail;
    }

    /**
     * @return string
     */
    public function getSpectatorId(): string
    {
        return $this->spectatorId;
    }

    /**
     * @param string $spectatorId
     */
    public function setSpectatorId(string $spectatorId): void
    {
        $this->spectatorId = $spectatorId;
    }

    /**
     * @return null
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param null $orderDate
     */
    public function setOrderDate($orderDate): void
    {
        $this->orderDate = $orderDate;
    }



}