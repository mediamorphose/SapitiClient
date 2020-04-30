<?php

namespace Sapiti\Exceptions;


class InvalidHTTPMethodException extends \Exception
{
	CONST CODE=11;

    /**
     * InvalidMethodException constructor.
     * @param \Throwable $previous  The previous exception
     */
    public function __construct($previous = null)
    {
        parent::__construct("Invalid HTTP method", self::CODE, $previous);
    }
}
