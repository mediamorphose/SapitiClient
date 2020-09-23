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
	 * @param string $id
	 * @return Event|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getEvent(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/events/'.$id,[],'GET');
		return Event::getFromArray($apiResponse->getResponse());
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
	 * @param string $id
	 * @return Venue|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getVenue(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/venues/'.$id,[],'GET');
		return Venue::getFromArray($apiResponse->getResponse());
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
	 * @param string $id
	 * @return Attraction|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getAttraction(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/attractions/'.$id,[],'GET');
		return Attraction::getFromArray($apiResponse->getResponse());
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

	/**
	 * @param string $id
	 * @return Attraction|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getCategorie(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/attractions/categories/'.$id,[],'GET');
		return Attraction::getFromArray($apiResponse->getResponse());
	}



}