<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Catalogue\Stream;
use Sapiti\Objects\Shop\Payment;
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
		$apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['contactid'=>$contactId,'statusid'=>1],'PATCH');
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
	public function removeAllProductsFromOrder(string $orderId) {
		$apiResponse = $this->getAPIResponse('shop/products/',["orderid"=>$orderId],'DELETE');
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
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Shop\Stock|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStock(string $id) {
		$apiResponse = $this->getAPIResponse('shop/products/stocks/'.$id,[],'GET');
		return \Sapiti\Objects\Shop\Stock::getFromArray($apiResponse->getResponse());
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

	public function createOrUpdateMolliePaymentFromId(string $orderId, string $molliePaymentId) {
		$apiResponse = $this->getAPIResponse('shop/orders/payments/',['orderid'=>$orderId,'molliepaymentid'=>$molliePaymentId],'PATCH');
		return \Sapiti\Objects\Shop\Payment::getFromArray($apiResponse->getResponse());
	}


}