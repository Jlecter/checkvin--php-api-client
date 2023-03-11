<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Response\Error;

use CheckVin\Api\Http\Data\Error;
use CheckVin\Api\Http\Response\Abstraction\ErrorResponse;
use CheckVin\Api\Http\Response\ClientResponse;

/**
 * Class ApplicationErrorResponse.
 */
class ApplicationErrorResponse extends ErrorResponse
{
    private ClientResponse $response;
    
    /**
     * @param ClientResponse $response
     */
    public function __construct(ClientResponse $response)
    {
        $this->response = $response;
    }
    
    /**
     * @return Error
     */
    public function getError(): Error
    {
        return new Error($this->response);
    }
}
