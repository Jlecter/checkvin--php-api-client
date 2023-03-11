<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Response\Success;

use CheckVin\Api\Http\Response\Abstraction\SuccessResponse;
use CheckVin\Api\Http\Response\ClientResponse;

/**
 * Class ApplicationSuccessResponse.
 */
class ApplicationSuccessResponse extends SuccessResponse
{
    private array $data;
    
    /**
     * @param ClientResponse $response
     */
    public function __construct(ClientResponse $response)
    {
        $this->data = $response->getData();
    }
    
    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
