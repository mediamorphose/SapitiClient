<?php


namespace Sapiti\Objects\Catalogue;

use Sapiti\Objects\ApiObject;


class FinanceItem extends ApiObject
{

    const VALIDITY_UNKNOWN_CODE = -1;
    const VALIDITY_SOLD_OUT = -2;
    const VALIDITY_EXPIRED = -3;
    const VALIDITY_UNPAID = -4;
    const VALIDITY_VALID = 1;

    const TYPE_COUPON = 1401;
    const TYPE_CONTRIBUTION = 1402;

	protected $description = '';
	protected $shopUrl = '';
    protected $imageUrl = '';
    protected $typeId = 1401;

	protected $metaData=[];

    protected $validityId = -1;
    protected $validityDate = null;
    protected $amountLeft = 0;
    protected $couponCode = '';
    protected $orderId = '';
    protected $productId = '';


	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return FinanceItem|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var FinanceItem $result */
		$result = parent::getFromArray($data, $existingObject);

		if (isset($data['label'])) $result->setLabel($data['label']);
		if (isset($data['description'])) $result->setDescription($data['description']);
        if (isset($data['image_url'])) $result->setImageUrl($data['image_url']);
		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);

		if(isset($data['metadata']) && is_array($data['metadata']))
			$result->setMetaData($data['metadata']);


        if (isset($data['validityid'])) $result->setValidityId($data['validityid']);
        if(isset($data['validitydate']))  {
            $date = \DateTime::createFromFormat(\DateTimeInterface::ATOM, $data['validitydate']);
            $result->setValidityDate($date);
        }
        if (isset($data['amountleft'])) $result->setAmountLeft($data['amountleft']);
        if (isset($data['couponcode'])) $result->setCouponCode($data['couponcode']);
        if (isset($data['orderid'])) $result->setOrderId($data['orderid']);
        if (isset($data['productid'])) $result->setProductId($data['productid']);

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
     * @return int
     */
    public function getValidityId(): int
    {
        return $this->validityId;
    }

    /**
     * @param int $validityId
     */
    public function setValidityId(int $validityId): void
    {
        $this->validityId = $validityId;
    }

    /**
     * @return int
     */
    public function getAmountLeft(): int
    {
        return $this->amountLeft;
    }

    /**
     * @param int $amountLeft
     */
    public function setAmountLeft(int $amountLeft): void
    {
        $this->amountLeft = $amountLeft;
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

    /**
     * @return string
     */
    public function getCouponCode(): string
    {
        return $this->couponCode;
    }

    /**
     * @param string $couponCode
     */
    public function setCouponCode(string $couponCode): void
    {
        $this->couponCode = $couponCode;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }



}