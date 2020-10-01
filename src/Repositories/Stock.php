<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;


class Stock extends Repository
{
	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getStocks(array $params=[]) {
		$apiResponse = $this->getAPIResponse('products/stocks',$params,'GET');
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
		$apiResponse = $this->getAPIResponse('products/stocks/'.$id,[],'GET');
		return \Sapiti\Objects\Shop\Stock::getFromArray($apiResponse->getResponse());
	}




}