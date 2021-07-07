<?php
namespace Sapiti\Repositories;


use Sapiti\Objects\AccessControl\AccessCode;
use Sapiti\Objects\AccessControl\Device;

class AccessControl extends Repository
{

	/**
	 * @param string $id
	 * @return Device
	 * @throws \Sapiti\Exceptions\ApiException
	 * @throws \Sapiti\Exceptions\CurlException
	 * @throws \Sapiti\Exceptions\InvalidHTTPMethodException
	 * @throws \Sapiti\Exceptions\JsonException
	 */
	public function getDeviceFromId(string $id) {
		$apiResponse = $this->getAPIResponse('/accesscontrol/deviceinfo/',['deviceid'=>$id],'GET');
		return Device::getFromArray($apiResponse->getResponse());
	}

	public function controlCodesForDeviceAndEventId(array $codesToControl, $deviceId, $eventId, $confirmedByOperator=false, $exitMode=false) {
		$apiResponse = $this->getAPIResponse('/accesscontrol/events/'.$eventId.'/control',['deviceid'=>$deviceId,'codes'=>$codesToControl, 'confirmedbyoperator'=>$confirmedByOperator],'PATCH');
		return AccessCode::getMultipleFromArray($apiResponse->getResponse());
	}



}