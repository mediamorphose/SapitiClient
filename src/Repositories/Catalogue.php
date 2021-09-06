<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Catalogue\Merchandising;
use Sapiti\Objects\Catalogue\Pack;
use Sapiti\Objects\Catalogue\Stream;

class Catalogue extends Repository
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
		$apiResponse = $this->getAPIResponse('catalogue/streams/'.$id,[],'GET');
		return Stream::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @param $contactId
	 * @return \Sapiti\Objects\ApiObject|\Sapiti\Objects\Contact\Contact|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getControlStreamAccessWithContactId(string $id, string $contactId) {
		$apiResponse = $this->getAPIResponse('catalogue/streams/'.$id.'/control',['contactid'=>$contactId],'GET');
		return $apiResponse->getResponse();
	}

	/**
	 * @param string $id
	 * @param string $accessCode
	 * @return \Sapiti\Objects\Contact\Contact
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getControlStreamAccessWithAccessCode(string $id, string $accessCode) {
		$apiResponse = $this->getAPIResponse('catalogue/streams/'.$id.'/control',['accesscode'=>$accessCode],'GET');
		return  $apiResponse->getResponse();
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getMerchandisings(array $params=[]) {
		$apiResponse = $this->getAPIResponse('catalogue/merchandising',$params,'GET');
		return Merchandising::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return Merchandising|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getMerchandising(string $id) {
		$apiResponse = $this->getAPIResponse('catalogue/merchandising/'.$id,[],'GET');
		return Merchandising::getFromArray($apiResponse->getResponse());
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getMerchandisingCategories(array $params=[]) {
		$apiResponse = $this->getAPIResponse('catalogue/merchandising/categories',$params,'GET');
		return Category::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return Category|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getMerchandisingCategory(string $id) {
		$apiResponse = $this->getAPIResponse('catalogue/merchandising/categories/'.$id,[],'GET');
		return Category::getFromArray($apiResponse->getResponse());
	}


	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPacks(array $params=[]) {
		$apiResponse = $this->getAPIResponse('catalogue/packs',$params,'GET');
		return Pack::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return Pack|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getPack(string $id) {
		$apiResponse = $this->getAPIResponse('catalogue/packs/'.$id,[],'GET');
		return Pack::getFromArray($apiResponse->getResponse());
	}




}