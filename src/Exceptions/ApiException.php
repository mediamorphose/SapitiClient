<?php

namespace Sapiti\Exceptions;


use Sapiti\Objects\System\ApiError;

class ApiException extends \Exception
{
	/**
	 * ApiException constructor.
	 * @param ApiError $apiError
	 * @param null $previous
	 */
    public function __construct(ApiError $apiError, $previous = null)
    {
        parent::__construct($apiError->getMessage(),$apiError->getCode(), $previous);
    }
}
