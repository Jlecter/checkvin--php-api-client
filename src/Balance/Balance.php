<?php
declare(strict_types=1);

namespace CheckVin\Api\Balance;

use CheckVin\Api\Config\ApiUriGlossary;
use CheckVin\Api\Http\Client;
use CheckVin\Api\Http\Response\Abstraction\ApiResponse;
use CheckVin\Api\Http\Response\Error\ApplicationErrorResponse;
use CheckVin\Api\Http\Response\Success\ApplicationSuccessResponse;

/**
 * Class Balance.
 */
class Balance
{
    private const QUERY_PARAM_API_KEY = 'api_key';
    private string $apiKey;
    private Client $client;
    
    public function __construct(string $apiKey, Client $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }
    
    /**
     * @return ApiResponse
     */
    public function getBalance(): ApiResponse
    {
        $queryParams = $this->prepareQueryParams($this->apiKey);
        $response = $this->client->request(ApiUriGlossary::CHECK_BALANCE_PATH, $queryParams);
        
        if ($response->getCurlHttpCode() !== ApplicationSuccessResponse::SUCCESS_CODE) {
            return new ApplicationErrorResponse($response);
        }
        
        return new ApplicationSuccessResponse($response);
    }
    
    /**
     * @param string $apiKey
     *
     * @return array
     */
    private function prepareQueryParams(string $apiKey): array
    {
        return [
            self::QUERY_PARAM_API_KEY => $apiKey
        ];
    }
}
