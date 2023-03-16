<?php
declare(strict_types=1);

namespace CheckVin\Api\Balance;

use CheckVin\Api\Config\ApiUriGlossary;
use CheckVin\Api\Http\Client\ClientInterface;
use CheckVin\Api\Http\Response\Abstraction\ApiResponse;

/**
 * Class BalanceDataProvider.
 */
class BalanceDataProvider implements BalanceDataProviderInterface
{
    private const QUERY_PARAM_API_KEY = 'api_key';
    private string $apiKey;
    private ClientInterface $client;
    
    public function __construct(string $apiKey, ClientInterface $client)
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
    
        return $this->client->makeResponse($response);
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
