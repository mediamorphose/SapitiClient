<?php
namespace Sapiti\Repositories;


use Sapiti\Objects\AccessControl\AccessCode;
use Sapiti\Objects\AccessControl\Device;
use Sapiti\Objects\Agenda\Event;

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
		$method='PATCH';
		if($exitMode) $method='DELETE';
		$apiResponse = $this->getAPIResponse('/accesscontrol/events/'.$eventId.'/control',['deviceid'=>$deviceId,'codes'=>$codesToControl, 'confirmedbyoperator'=>$confirmedByOperator],$method);
		return AccessCode::getMultipleFromArray($apiResponse->getResponse());
	}

    public function getEvents(string $id, array $params=[]) {
        $params['deviceid']=$id;
        $apiResponse = $this->getAPIResponse('accesscontrol/events',$params,'GET');
        return Event::getMultipleFromArray($apiResponse->getResponse());
    }

}