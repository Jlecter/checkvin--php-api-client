<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Client;

use CheckVin\Api\Http\Response\Abstraction\ApiResponse;
use CheckVin\Api\Http\Response\ClientResponse;

/**
 * Interface ClientInterface.
 */
interface ClientInterface
{
    /**
     * @param string $path
     * @param array  $params
     *
     * @return ClientResponse
     */
    public function request(string $path, array $params): ClientResponse;
    
    /**
     * @param ClientResponse $clientResponse
     *
     * @return ApiResponse
     */
    public function makeResponse(ClientResponse $clientResponse): ApiResponse;
}
