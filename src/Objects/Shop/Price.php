<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class Price extends ApiObject
{

	protected $description='';
	protected $amount=-1;
    protected $maxamount=-1;
    protected $amontStep=1;
    protected $step=1;
	protected $currency='EUR';
	protected $quantityMin=-1;
	protected $quantityMax=-1;
    protected $quantityByWeight=false;

    protected $promoDescription='';
    protected $promoInitialPrice=-1;

	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Price $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['quantity_min'])) $result->setQuantityMin($data['quantity_min']);
		if (isset($data['quantity_max'])) $result->setQuantityMax($data['quantity_max']);
        if (isset($data['quantity_step'])) $result->setQuantityStep($data['quantity_step']);
        if (isset($data['quantity_byweight'])) $result->setQuantityByWeight($data['quantity_byweight']);
		if (isset($data['value']['amount'])) $result->setAmount($data['value']['amount']);
        if (isset($data['value']['maxamount'])) $result->setMaxamount($data['value']['maxamount']);
		if (isset($data['value']['currency'])) $result->setCurrency($data['value']['currency']);
        if (isset($data['value']['step'])) $result->setAmontStep($data['value']['step']);
        if (isset($data['promo']['description'])) $result->setPromoDescription($data['promo']['description']);
        if (isset($data['promo']['initalprice'])) $result->setPromoInitialPrice($data['promo']['initalprice']);
		return $result;
	}


    public function isARange() : bool {
        return $this->getMaxamount()>0;
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
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(int $amount): void
	{
		$this->amount = $amount;
	}

	/**
	 * @return string
	 */
	public function getCurrency(): string
	{
		return $this->currency;
	}

	/**
	 * @param string $currency
	 */
	public function setCurrency(string $currency): void
	{
		$this->currency = $currency;
	}

	/**
	 * @return int
	 */
	public function getQuantityMin(): int
	{
		return $this->quantityMin;
	}

	/**
	 * @param int $quantityMin
	 */
	public function setQuantityMin(int $quantityMin): void
	{
		$this->quantityMin = $quantityMin;
	}

	/**
	 * @return int
	 */
	public function getQuantityMax(): int
	{
		return $this->quantityMax;
	}

	/**
	 * @param int $quantityMax
	 */
	public function setQuantityMax(int $quantityMax): void
	{
		$this->quantityMax = $quantityMax;
	}

    /**
     * @return string
     */
    public function getPromoDescription(): string
    {
        return $this->promoDescription;
    }

    /**
     * @param string $promoDescription
     */
    public function setPromoDescription(string $promoDescription): void
    {
        $this->promoDescription = $promoDescription;
    }

    /**
     * @return int
     */
    public function getPromoInitialPrice(): int
    {
        return $this->promoInitialPrice;
    }

    /**
     * @param int $promoInitialPrice
     */
    public function setPromoInitialPrice(int $promoInitialPrice): void
    {
        $this->promoInitialPrice = $promoInitialPrice;
    }

    /**
     * @return int
     */
    public function getMaxamount(): int
    {
        return $this->maxamount;
    }

    /**
     * @param int $maxamount
     */
    public function setMaxamount(int $maxamount): void
    {
        $this->maxamount = $maxamount;
    }

    /**
     * @return int
     */
    public function getStep(): int
    {
        return $this->getQuantityStep();
    }

    /**
     * @param int $step
     */
    public function setStep(int $step): void
    {
       $this->setQuantityStep($step);
    }

    /**
     * @return int
     */
    public function getQuantityStep(): int
    {
        return $this->step;
    }

    /**
     * @param int $step
     */
    public function setQuantityStep(int $step): void
    {
        $this->step = $step;
    }

    public function getAmontStep(): int
    {
        return $this->amontStep;
    }

    public function setAmontStep(int $amontStep): void
    {
        $this->amontStep = $amontStep;
    }

    public function isQuantityByWeight(): bool
    {
        return $this->quantityByWeight;
    }

    public function setQuantityByWeight(bool $quantityByWeight): void
    {
        $this->quantityByWeight = $quantityByWeight;
    }





}