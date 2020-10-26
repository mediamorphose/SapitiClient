<?php
namespace Sapiti\Repositories;


use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;

class Product extends Repository
{
	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getProducts(array $params=[]) {
		$apiResponse = $this->getAPIResponse('products',$params,'GET');
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
		$apiResponse = $this->getAPIResponse('products/'.$id,[],'GET');
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
		$apiResponse = $this->getAPIResponse('/products/'.$id,[],'DELETE');
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
		$apiResponse = $this->getAPIResponse('/products/',["orderid"=>$orderId],'DELETE');
		return $apiResponse->isSuccess();
	}




}