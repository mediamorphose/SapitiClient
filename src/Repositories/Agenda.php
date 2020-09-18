<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Agenda\Venue;

class Agenda extends Repository
{
	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getEvents(array $params=[]) {
		$apiResponse = $this->getAPIResponse('agenda/events',$params,'GET');
		return Event::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getVenues(array $params=[]) {
		$apiResponse = $this->getAPIResponse('agenda/venues',$params,'GET');
		return Venue::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getAttractions(array $params=[]) {
		$apiResponse = $this->getAPIResponse('agenda/attractions',$params,'GET');
		return Attraction::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param array $params
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getCategories(array $params=[]) {
		$apiResponse = $this->getAPIResponse('agenda/attractions/categories',$params,'GET');
		return Category::getMultipleFromArray($apiResponse->getResponse());
	}



}