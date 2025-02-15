<?php

namespace AppleMapsServerApiClient\Exception\Client;

use AppleMapsServerApiClient\Dto\Common\ErrorResponse;
use Exception;
use Throwable;

class HttpResponseException extends Exception
{
    protected ErrorResponse $response;


    public function __construct(ErrorResponse $errorResponse, string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->response = $errorResponse;
    }


    public function getResponse(): ErrorResponse
    {
        return $this->response;
    }
}