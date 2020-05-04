<?php


namespace Sapiti\Objects\Business;


use Sapiti\Objects\ApiObject;

class Client extends ApiObject
{
	/**
	 * @param null $data
	 * @param Client|null $existingObject
	 * @return Client|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		return parent::getFromArray($data,$existingObject);
	}
}