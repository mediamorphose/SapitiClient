<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Catalogue\Stream;
use Sapiti\Objects\Shop\Counter;
use Sapiti\Objects\Shop\Order;
use Sapiti\Objects\Shop\Payment;
use Sapiti\Objects\Shop\PaymentMethod;
use Sapiti\Objects\Shop\PlanCategory;
use Sapiti\Objects\Shop\Product;
use Sapiti\Objects\Shop\PromoCode;
use Sapiti\Objects\Shop\Stock;
use Sapiti\Objects\Shop\StockRequest;
use Sapiti\Objects\Shop\TicketSet;

class Shop extends Repository
{

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getOrders(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/orders',$params,'GET');
		return \Sapiti\Objects\Shop\Order::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Shop\Order|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getOrder(string $id) {
		$apiResponse = $this->getAPIResponse('shop/orders/'.$id,[],'GET');
		return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
	}

	public function confirmOrder(string $orderId, string $contactId) {
		$apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['contactid'=>$contactId,'statusid'=>Order::STATUS_CONFIRMED],'PATCH');
		return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
	}

    public function setMetadataToOrder(string $orderId, array $metaData=[]): Order
    {
        $apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['metadata'=>json_encode($metaData, true)],'PATCH');
        return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
    }

    public function setLanguageToOrder(string $orderId, $language='fr'): Order
    {
        $apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['language'=>$language],'PATCH');
        return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
    }

    public function setNotesToOrder(string $orderId, string $notes=''): Order
    {
        $apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['notes'=>$notes],'PATCH');
        return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
    }

	public function changeOrderStatus(string $orderId, int $statusId) {
		$apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['statusid'=>$statusId],'PATCH');
		return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
	}

	public function clearOrder(string $orderId) {
		$apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,[],'DELETE');
		return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getProducts(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/products',$params,'GET');
		return \Sapiti\Objects\Shop\Product::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Shop\Product|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getProduct(string $id) {
		$apiResponse = $this->getAPIResponse('shop/products/'.$id,[],'GET');
		return \Sapiti\Objects\Shop\Product::getFromArray($apiResponse->getResponse());
	}

	public function updateProduct(Product $product, $params=[]): ?Product
	{
		$apiResponse = $this->getAPIResponse('shop/products/'.$product->getId(),$params,'PATCH');
		return Product::getFromArray($apiResponse->getResponse());
	}

	public function attachProductToMainProduct(Product $product, Product $mainProduct, $params=[]): ?Product
	{
		$params['mainproductid']=$mainProduct->getId();
		$apiResponse = $this->getAPIResponse('shop/products/'.$product->getId().'/attach',$params,'PATCH');
		return Product::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return bool
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function removeProductFromOrder(string $id) {
		$apiResponse = $this->getAPIResponse('shop/products/'.$id,[],'DELETE');
		return $apiResponse->isSuccess();
	}

	/**
	 * @param string $orderId
	 * @return bool
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function removeAllProductsFromOrder(string $orderId,array $params=[]) {
        $params["orderid"]=$orderId;
		$apiResponse = $this->getAPIResponse('shop/products/',$params,'DELETE');
		return $apiResponse->isSuccess();
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStocks(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/products/stocks',$params,'GET');
		return \Sapiti\Objects\Shop\Stock::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @param array $params
	 * @return Stock
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStock(string $id, array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/products/stocks/'.$id,$params,'GET');
		return \Sapiti\Objects\Shop\Stock::getFromArray($apiResponse->getResponse());
	}

    public function getStockPlanCategories(string $stockId, array $params=[])
    {
        $apiResponse = $this->getAPIResponse('shop/products/stocks/plancategories/'.$stockId,$params,'GET');
        return PlanCategory::getMultipleFromArray($apiResponse->getResponse());
    }

    public function setStockPlanSeatIdForOrder(string $stockId, string $orderId, string $planSeatId, array $params=[])
    {
        $params['orderid']=$orderId;
        $params['planseatid']=$planSeatId;
        $apiResponse = $this->getAPIResponse('shop/products/stocks/plancategories/'.$stockId,$params,'PATCH');
        return PlanCategory::getFromArray($apiResponse->getResponse());
    }

    public function getSuggestedStocks(string $id, array $params=[]) {
        $apiResponse = $this->getAPIResponse('shop/products/stocks/suggestions/'.$id,$params,'GET');
        return \Sapiti\Objects\Shop\Stock::getMultipleFromArray($apiResponse->getResponse());
    }

    public function adaptStock(string $id, array $params=[]) {
        $apiResponse = $this->getAPIResponse('shop/products/stocks/adapt/'.$id,$params,'PATCH');
        return $apiResponse->isSuccess();
    }


	public function requestStock(array $requests=[]) {
		$apiResponse = $this->getAPIResponse('shop/products/',['requests'=>StockRequest::getMultipleToArray($requests)],'POST');
		return \Sapiti\Objects\Shop\Product::getMultipleFromArray($apiResponse->getResponse());
	}


	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPromoCodes(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/promocodes',$params,'GET');
		return PromoCode::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return PromoCode|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPromoCode(string $id) {
		$apiResponse = $this->getAPIResponse('shop/promocodes/'.$id,[],'GET');
		return PromoCode::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param $label
	 * @param Stock $stock
	 * @return Stock|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function testPromoCodeLabelForStock($label, Stock $stock) {
		$this->setCacheDuration(0);
		$promoCodes = $this->getPromoCodes(['label'=>$label,"stockid"=>$stock->getId()]);
		if(is_array($promoCodes) && sizeof($promoCodes)>0)
			return $promoCodes[0];
		return null;
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getTicketSets(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/orders/tickets/',$params,'GET');
		return TicketSet::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param array $params
	 * @return bool|mixed
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPDFTicket(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/orders/tickets/pdf/',$params,'GET');
		return $apiResponse->getResponse();
	}

	public function getPaymentMethods(array $params=[]): array
	{
		$apiResponse = $this->getAPIResponse('shop/paymentmethods/',$params,'GET');
		return PaymentMethod::getMultipleFromArray($apiResponse->getResponse());
	}

    public function getPaymentMethod(string $id): ?PaymentMethod {
        $apiResponse = $this->getAPIResponse('shop/paymentmethods/'.$id,[],'GET');
        return PaymentMethod::getFromArray($apiResponse->getResponse());
    }

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPayments(array $params=[]): array
	{
		$apiResponse = $this->getAPIResponse('shop/orders/payments/',$params,'GET');
		return Payment::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return Payment|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPayment(string $id) {
		$apiResponse = $this->getAPIResponse('shop/orders/payments/'.$id,[],'GET');
		return Payment::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param Payment $payment
	 * @return Payment|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function updatePayment(Payment $payment): ?Payment
	{
		$dataArray = Payment::toArray($payment);
		$apiResponse = $this->getAPIResponse('shop/orders/payments/'.$payment->getId(),$dataArray,'PATCH');
		return $payment::getFromArray($apiResponse->getResponse());
	}

    public function deletePayment(Payment $payment): bool
    {
        $dataArray = Payment::toArray($payment);
        $apiResponse = $this->getAPIResponse('shop/orders/payments/'.$payment->getId(),$dataArray,'DELETE');
        return $apiResponse->isSuccess();
    }

	/**
	 * @param Payment $payment
	 * @return Payment|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function createPayment(Payment $payment) : ?Payment {
		$dataArray = Payment::toArray($payment);
		$apiResponse = $this->getAPIResponse('shop/orders/payments',$dataArray,'POST');
		return $payment::getFromArray($apiResponse->getResponse());
	}

	public function createOrUpdateMolliePaymentFromId(string $orderId, string $molliePaymentId) {
		$apiResponse = $this->getAPIResponse('shop/orders/payments/',['orderid'=>$orderId,'molliepaymentid'=>$molliePaymentId],'PATCH');
		return \Sapiti\Objects\Shop\Payment::getFromArray($apiResponse->getResponse());
	}

	public function getCounters(array $params=[]) {
		$apiResponse = $this->getAPIResponse('shop/counters',$params,'GET');
		return \Sapiti\Objects\Shop\Counter::getMultipleFromArray($apiResponse->getResponse());
	}

	public function getCounter(string $id) {
		$apiResponse = $this->getAPIResponse('shop/counters/'.$id,[],'GET');
		return Counter::getFromArray($apiResponse->getResponse());
	}

	public function getCounterSessions($counterId, array $params=[]) {
		$params['counterid']=$counterId;
		$apiResponse = $this->getAPIResponse('shop/counters/sessions',$params,'GET');
		return \Sapiti\Objects\Shop\CounterSession::getMultipleFromArray($apiResponse->getResponse());
	}


	public function startCounterSession($counterId, $startAmountCents=0,$userLabel='', $externalUserId='') {
		$params['counterid']=$counterId;
		$params['starttime']=date("c");
		$params['startamount']=$startAmountCents;
		$params['userlabel']=$userLabel;
		$params['externaluserid']=$externalUserId;
		$apiResponse = $this->getAPIResponse('shop/counters/sessions',$params,'POST');
		return \Sapiti\Objects\Shop\CounterSession::getFromArray($apiResponse->getResponse());
	}

	public function stopCounterSession($sessionId, $endAmountCents=0,$notes='') {
		$params['endtime']=date("c");
		$params['endamount']=$endAmountCents;
		$params['notes']=$notes;
		$apiResponse = $this->getAPIResponse('shop/counters/sessions/'.$sessionId,$params,'PATCH');
		return \Sapiti\Objects\Shop\CounterSession::getFromArray($apiResponse->getResponse());
	}


}