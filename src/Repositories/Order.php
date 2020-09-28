<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;


class Order extends Repository
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
		$apiResponse = $this->getAPIResponse('orders',$params,'GET');
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
		$apiResponse = $this->getAPIResponse('orders/'.$id,[],'GET');
		return \Sapiti\Objects\Shop\Order::getFromArray($apiResponse->getResponse());
	}




}