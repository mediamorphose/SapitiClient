<?php


namespace Sapiti\Objects\Shop;


use Sapiti\Objects\ApiObject;

class StockRequest extends ApiObject
{
	protected $quantity=1;
	protected $stockId='';
	protected $categoryId='';
	protected $priceId='';
    protected $forcedPriceValue='';
	protected $orderId='';
	protected $counterId='';
	protected $requestedPrice=null;
	protected $promocodesIds=[];


	/**
	 * @param StockRequest $existingObject
	 * @return array
	 */
	static function toArray(ApiObject $existingObject)
	{
		$data = [];
		$data['quantity']=$existingObject->getQuantity();
		$data['stockid']=$existingObject->getStockId();
		$data['categoryid']=$existingObject->getCategoryId();
		$data['priceid']=$existingObject->getPriceId();
        $data['forcedpricevalue']=$existingObject->getForcedPriceValue();
		$data['requestedprice']=$existingObject->getRequestedPrice();
		$data['promocodeids']=$existingObject->getPromocodesIds();
		if($existingObject->getOrderId())
			$data['orderid']=$existingObject->getOrderId();
		if($existingObject->getCounterId())
			$data['counterid']=$existingObject->getCounterId();
		return $data;
	}

	/**
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity(int $quantity): void
	{
		$this->quantity = $quantity;
	}

	/**
	 * @return string
	 */
	public function getStockId(): string
	{
		return $this->stockId;
	}

	/**
	 * @param string $stockId
	 */
	public function setStockId(string $stockId): void
	{
		$this->stockId = $stockId;
	}

	/**
	 * @return string
	 */
	public function getCategoryId(): string
	{
		return $this->categoryId;
	}

	/**
	 * @param string $categoryId
	 */
	public function setCategoryId(string $categoryId): void
	{
		$this->categoryId = $categoryId;
	}

	/**
	 * @return string
	 */
	public function getPriceId(): string
	{
		return $this->priceId;
	}

	/**
	 * @param string $priceId
	 */
	public function setPriceId(string $priceId): void
	{
		$this->priceId = $priceId;
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
	 * @return array
	 */
	public function getPromocodesIds(): array
	{
		return $this->promocodesIds;
	}

	/**
	 * @param array $promocodesIds
	 */
	public function setPromocodesIds(array $promocodesIds): void
	{
		$this->promocodesIds = $promocodesIds;
	}

	/**
	 * @return string
	 */
	public function getCounterId(): string
	{
		return $this->counterId;
	}

	/**
	 * @param string $counterId
	 */
	public function setCounterId(string $counterId): void
	{
		$this->counterId = $counterId;
	}


	public function getRequestedPrice()
	{
		return $this->requestedPrice;
	}


	public function setRequestedPrice($requestedPrice): void
	{
		$this->requestedPrice = $requestedPrice;
	}


    public function getForcedPriceValue()
    {
        return $this->forcedPriceValue;
    }


    public function setForcedPriceValue($forcedPriceValue): void
    {
        $this->forcedPriceValue = $forcedPriceValue;
    }








}