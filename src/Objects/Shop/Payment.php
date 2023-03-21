<?php


namespace Sapiti\Objects\Shop;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Status;

class Payment extends ApiObject
{


	protected $orderId = '';
	protected $paymentMethodId = '';
	protected $counterId = '';
	protected $externalId = '';
	protected $amount=0;
	protected $currency='EUR';

    protected $couponCode='';

	/** @var PaymentMethod  */
	protected $paymentMethod=null;

	/** @var Counter  */
	protected $counter=null;

	/** @var Status|null */
	protected $status = null;

	protected $paymentDate = false;


	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Payment $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['orderid'])) $result->setOrderId($data['orderid']);
		if (isset($data['paymentmethodid'])) $result->setPaymentMethodId($data['paymentmethodid']);
		if (isset($data['externalid'])) $result->setExternalId($data['externalid']);
        if (isset($data['couponcode'])) $result->setCouponCode($data['couponcode']);
		if (isset($data['value']['amount'])) $result->setAmount($data['value']['amount']);
		if (isset($data['value']['currency'])) $result->setCurrency($data['value']['currency']);

		if(isset($data['paymentdate']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['paymentdate']);
			$result->setPaymentDate($date);
		}

		if(isset($data['status'])) {
			$result->setStatus(Status::getFromArray($data['status']));
		}

		if(isset($data['paymentmethod']))
			$result->setPaymentMethod(PaymentMethod::getFromArray($data['paymentmethod']));

		if(isset($data['counter']))
			$result->setCounter(Counter::getFromArray($data['counter']));

		return $result;
	}

	static function toArray(ApiObject $existingObject) {
		/** @var Payment $existingObject */
		$data=[];
		$data['orderid']=$existingObject->getOrderId();
		$data['paymentmethodid']=$existingObject->getPaymentMethodId();
		$data['counterid']=$existingObject->getCounterId();
		$data['externalid']=$existingObject->getExternalId();
        $data['couponcode']=$existingObject->getCouponCode();
		$data['value']['amount']=$existingObject->getAmount();
		$data['value']['currency']=$existingObject->getCurrency();

		if($existingObject->getStatus())
			$data['status']=Status::toArray($existingObject->getStatus());
		$data['paymentdate']=null;
		if($existingObject->getPaymentDate())
			$data['paymentdate']=$existingObject->getPaymentDate()->format('c');


		return $data;
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
	public function getPaymentMethodId(): string
	{
		return $this->paymentMethodId;
	}

	/**
	 * @param string $paymentMethodId
	 */
	public function setPaymentMethodId(string $paymentMethodId): void
	{
		$this->paymentMethodId = $paymentMethodId;
	}

	/**
	 * @return string
	 */
	public function getExternalId(): string
	{
		return $this->externalId;
	}

	/**
	 * @param string $externalId
	 */
	public function setExternalId(string $externalId): void
	{
		$this->externalId = $externalId;
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
	 * @param \DateTime|null $created
	 */
	public function setPaymentDate(\DateTime $created=null)
	{
		$this->paymentDate = $created;
	}

	/**
	 * @return \DateTime|false
	 */
	public function getPaymentDate()
	{
		return $this->paymentDate;
	}

	/**
	 * @return Status|null
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param Status|null $status
	 */
	public function setStatus(Status $status=null)
	{
		$this->status = $status;
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

	/**
	 * @return PaymentMethod|null
	 */
	public function getPaymentMethod(): ?PaymentMethod
	{
		return $this->paymentMethod;
	}

	/**
	 * @param PaymentMethod $paymentMethod
	 */
	public function setPaymentMethod(?PaymentMethod $paymentMethod): void
	{
		$this->paymentMethod = $paymentMethod;
	}

	/**
	 * @return Counter
	 */
	public function getCounter(): ?Counter
	{
		return $this->counter;
	}

	/**
	 * @param Counter $counter
	 */
	public function setCounter(?Counter $counter): void
	{
		$this->counter = $counter;
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






}