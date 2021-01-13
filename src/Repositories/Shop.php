<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Catalogue\Stream;
use Sapiti\Objects\Shop\PromoCode;
use Sapiti\Objects\Shop\Stock;
use Sapiti\Objects\Shop\StockRequest;

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
	public function getStreams(array $params=[]) {
		$apiResponse = $this->getAPIResponse('catalogue/streams',$params,'GET');
		return Stream::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return Stream|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStream(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/Streams/'.$id,[],'GET');
		return Stream::getFromArray($apiResponse->getResponse());
	}


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

	public function setMolliePaymentId(string $orderId, string $paymentId) {
		$apiResponse = $this->getAPIResponse('shop/orders/'.$orderId,['molliepaymentid'=>$paymentId],'PATCH');
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


}