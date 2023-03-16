<?php
declare(strict_types=1);

namespace CheckVin\Api\Provider\Balance;

use CheckVin\Api\Config\ApiUriGlossary;
use CheckVin\Api\Config\Config;
use CheckVin\Api\Http\Client\Client;
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
    
    /**
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(new Config);
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
