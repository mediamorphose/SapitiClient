<?php
namespace Sapiti\Repositories;

use Sapiti\Exceptions\ApiException;
use Sapiti\Exceptions\CurlException;
use Sapiti\Exceptions\InvalidHTTPMethodException;
use Sapiti\Exceptions\JsonException;
use Sapiti\Objects\Agenda\Event;

class Agenda extends Repository
{
	/**
	 * @param int $size
	 * @param int $startPosition
	 * @return array
	 * @throws ApiException
	 * @throws CurlException
	 * @throws InvalidHTTPMethodException
	 * @throws JsonException
	 */
	public function getEvents($size=0, $startPosition=0) {
		$data = $this->getClient()->getAuthenticationParams();
		$data = $this->getClient()->addListLimitParams($data, $size, $startPosition);

		$apiResponse = $this->getClient()->callAPI('agenda/events','GET',$data);
		$apiError = $apiResponse->getApiError();
		if ($apiError) throw new ApiException($apiError, null);
		return Event::getMultipleFromArray($apiResponse->getResponse());
	}


}