<?php

namespace Sapiti\Exceptions;


class JsonException extends \Exception
{
	CONST CODE=1020;

    /**
     * CurlException constructor.
     * @param \Throwable $previous  The previous exception
     */
    public function __construct($previous = null)
    {
        parent::__construct("Invalid json format in server response",self::CODE, $previous);
    }
}
