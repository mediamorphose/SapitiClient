<?php


namespace Sapiti\Objects\Business;


use Sapiti\Objects\ApiObject;

class Application extends ApiObject
{

	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return Application|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject=null) {
		$result = parent::getFromArray($data, $existingObject);
		if(isset($data['client']))
			$result->setClient(Client::getFromArray($data['client']));

		return $result;
	}

	/** @var Client  */
	protected $client=null;

	/**
	 * @return Client
	 */
	public function getClient(): Client
	{
		return $this->client;
	}

	/**
	 * @param Client $client
	 */
	public function setClient(Client $client)
	{
		$this->client = $client;
	}




}