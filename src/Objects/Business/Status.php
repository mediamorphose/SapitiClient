<?php


namespace Sapiti\Objects\Business;


use Sapiti\Objects\ApiObject;

class Status extends ApiObject
{
	/**
	 * @param null $data
	 * @param Status|null $existingObject
	 * @return Status|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		return parent::getFromArray($data,$existingObject);
	}
}