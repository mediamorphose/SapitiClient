<?php
namespace Sapiti\Repositories;

use Sapiti\SapitiClient;

class Repository
{
	/** @var SapitiClient  */
	protected $client=null;

	public function __construct(SapitiClient $client)
	{
		$this->client=$client;
	}

	/**
	 * @return SapitiClient
	 */
	public function getClient(): SapitiClient
	{
		return $this->client;
	}




}