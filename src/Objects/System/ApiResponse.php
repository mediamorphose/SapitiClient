<?php

namespace Sapiti\Objects\System;


class ApiResponse {

	protected $environment = '?';
	protected $apiVersion = '?';
	protected $dateTime = false;
	protected $cached = false;
	protected $success = false;
	protected $response = false;
	protected $error = null;
	protected $statusCode = 0;
	protected $rawJson='';

	/**
	 * APIResponse constructor.
	 * @param array $data
	 * @param string $rawJason
	 */
	public function __construct($data=[], $rawJason='')
	{
		if(isset($data['success'])) $this->success = ($data['success']===true);
		if(isset($data['cached'])) $this->cached = ($data['cached']===true);
		if(isset($data['response'])) $this->response = $data['response'];
		if(isset($data['error'])) $this->error = $data['error'];
		if(isset($data['environment'])) $this->environment = $data['environment'];
		if(isset($data['api_version'])) $this->apiVersion = $data['api_version'];
		if(isset($data['status_code'])) $this->statusCode = $data['status_code'];
		if(isset($data['datetime']))  {
			$date = \DateTime::createFromFormat(\DateTime::ISO8601, $data['datetime']);
			$this->dateTime = $date;
		}
		$this->rawJson=$rawJason;

	}

	public function isSuccess() {
		return $this->success;
	}

	/**
	 * @return mixed|string
	 */
	public function getEnvironment()
	{
		return $this->environment;
	}

	/**
	 * @return mixed|string
	 */
	public function getApiVersion()
	{
		return $this->apiVersion;
	}

	/**
	 * @return \DateTime|false
	 */
	public function getDateTime()
	{
		return $this->dateTime;
	}

	/**
	 * @return bool
	 */
	public function isCached(): bool
	{
		return $this->cached;
	}

	/**
	 * @return bool|mixed
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * @return bool|mixed
	 */
	public function getApiError()
	{
		if (!is_array($this->error)) return null;
		$code='';
		$message='';
		if(isset($this->error['code'])) $code = $this->error['code'];
		if(isset($this->error['message'])) $code = $this->error['message'];
		return new ApiError($code,$message);
	}

	/**
	 * @return int|mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @return string
	 */
	public function getRawJson(): string
	{
		return $this->rawJson;
	}




}