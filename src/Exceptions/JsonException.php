<?php

namespace Sapiti\Exceptions;


class JsonException extends \Exception
{
	CONST CODE=1020;

	protected $jsonCode='';

	/**
	 * CurlException constructor.
	*/
    public function __construct($previous = null)
    {
        parent::__construct("Invalid json format in server response",self::CODE, $previous);
    }

	/**
	 * @return string
	 */
	public function getJsonCode(): string
	{
		return $this->jsonCode;
	}

	/**
	 * @param string $jsonCode
	 */
	public function setJsonCode(string $jsonCode): void
	{
		$this->jsonCode = $jsonCode;
		$this->message.=' : '.$jsonCode;
	}


}
