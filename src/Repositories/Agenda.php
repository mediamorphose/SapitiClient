<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Agenda\Attraction;
use Sapiti\Objects\Agenda\Category;
use Sapiti\Objects\Agenda\Event;
use Sapiti\Objects\Agenda\TimeSlot;
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
		$apiResponse = $this->getAPIResponse('agenda/events/',$params,'GET');
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

    public function duplicateEvent(string $id, $params=[]): ?Event
    {
        $apiResponse = $this->getAPIResponse('agenda/events/duplicate/'.$id,$params,'POST');
        return Event::getFromArray($apiResponse->getResponse());
    }

    public function updateEventStatus(string $id, int $newStatusId, $params=[]): ?Event
    {
        $params['statusid'] = $newStatusId;
        $apiResponse = $this->getAPIResponse('agenda/events/'.$id,$params,'PATCH');
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
	public function getTimeSlots(array $params=[]) {
		$apiResponse = $this->getAPIResponse('agenda/timeslots/',$params,'GET');
		return TimeSlot::getMultipleFromArray($apiResponse->getResponse());
	}

	/**
	 * @param string $id
	 * @return TimeSlot|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getTimeSlot(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/timeslots/'.$id,[],'GET');
		return TimeSlot::getFromArray($apiResponse->getResponse());
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
		$apiResponse = $this->getAPIResponse('agenda/venues/',$params,'GET');
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
		$apiResponse = $this->getAPIResponse('agenda/attractions/',$params,'GET');
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
	 * @param string $id
	 * @return Attraction|null
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getAttractionFromExternalId(string $id) {
		$attractions = $this->getAttractions(['externalid'=>$id]);
		if(sizeof($attractions)>0)
			return $attractions[0];
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
	public function getCategories(array $params=[]) {
		$apiResponse = $this->getAPIResponse('agenda/attractions/categories/',$params,'GET');
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
	public function getCategory(string $id) {
		$apiResponse = $this->getAPIResponse('agenda/attractions/categories/'.$id,[],'GET');
		return Category::getFromArray($apiResponse->getResponse());
	}



}