<?php

namespace Sapiti\Objects\System;


class ApiError {

	protected $code=0;
	protected $message = '';

	/**
	 * ApiError constructor.
	 * @param int $code
	 * @param string $message
	 */
	public function __construct($code, $message)
	{
		$this->code=$code;
		$this->message=$message;
	}

	public function __toString()
	{
		return 'Api error code : '.$this->code.' : '.$this->message;
	}

	/**
	 * @return int
	 */
	public function getCode(): int
	{
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}




}