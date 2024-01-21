<?php

declare(strict_types=1);

namespace CheckVin\Api\Provider\Vehicle;

use CheckVin\Api\Config\ApiUriGlossary;
use CheckVin\Api\Config\Config;
use CheckVin\Api\Http\Client\Client;
use CheckVin\Api\Http\Client\ClientInterface;
use CheckVin\Api\Http\Response\Abstraction\ApiResponse;

final class VehicleDataProvider implements VehicleDataProviderInterface
{
    private const QUERY_PARAM_API_KEY = 'api_key';
    private const QUERY_PARAM_VIN_CODE = 'vincode';
    private string $apiKey;
    private ClientInterface $client;
    
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(new Config());
    }
    
    public function getInfo(): ApiResponse
    {
        $queryParams = $this->prepareQueryParams($this->apiKey);
        $response = $this->client->request(ApiUriGlossary::VEHICLE_INFO_PATH, $queryParams);
    
        return $this->client->makeResponse($response);
    }
    
    /**
     * @return string[]
     */
    private function prepareQueryParams(string $apiKey, string $vinCode): array
    {
        return [
            self::QUERY_PARAM_API_KEY  => $apiKey,
            self::QUERY_PARAM_VIN_CODE => $vinCode
        ];
    }
}
