<?php

namespace Sapiti\Exceptions;


class CurlException extends \Exception
{
	CONST CODE=10;

    /**
     * CurlException constructor.
     * @param \Throwable $previous  The previous exception
     */
    public function __construct($ch, $previous = null)
    {
        $err = curl_error($ch);
        $errno = curl_errno($ch);
        parent::__construct("CURL error : $err", self::CODE, $previous);
    }
}
