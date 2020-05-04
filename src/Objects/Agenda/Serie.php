<?php


namespace Sapiti\Objects\Agenda;


use Sapiti\Objects\ApiObject;
use Sapiti\Objects\Business\Client;
use Sapiti\Objects\Business\Status;

class Serie extends ApiObject
{

	protected $shopUrl='';

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Serie|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		/** @var Serie $result */
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['shop_url'])) $result->setShopUrl($data['shop_url']);
		return $result;
	}


	/**
	 * @return string
	 */
	public function getShopUrl(): string
	{
		return $this->shopUrl;
	}

	/**
	 * @param string $shopurl
	 */
	public function setShopUrl(string $shopurl)
	{
		$this->shopUrl = $shopurl;
	}


}