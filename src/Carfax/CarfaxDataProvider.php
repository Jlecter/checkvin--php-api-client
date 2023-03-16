<?php
declare(strict_types=1);

namespace CheckVin\Api\Carfax;

use CheckVin\Api\Config\ApiUriGlossary;
use CheckVin\Api\Http\Client\ClientInterface;
use CheckVin\Api\Http\Response\Abstraction\ApiResponse;

/**
 * Class CarfaxDataProvider.
 */
class CarfaxDataProvider implements CarfaxDataProviderInterface
{
    private const QUERY_PARAM_API_KEY = 'api_key';
    private const QUERY_PARAM_VIN_CODE = 'vincode';
    private string $apiKey;
    private ClientInterface $client;
    
    public function __construct(string $apiKey, ClientInterface $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }
    
    /**
     * @param string $vinCode
     *
     * @return ApiResponse
     */
    public function getCarfaxForVinCode(string $vinCode): ApiResponse
    {
        $queryParams = $this->prepareQueryParams($this->apiKey, $vinCode);
        $response = $this->client->request(ApiUriGlossary::VIN_CARFAX_PATH, $queryParams);
    
        return $this->client->makeResponse($response);
    }
    
    /**
     * @param string $vinCode
     *
     * @return ApiResponse
     */
    public function checkReportExists(string $vinCode): ApiResponse
    {
        $queryParams = $this->prepareQueryParams($this->apiKey, $vinCode);
        $response = $this->client->request(ApiUriGlossary::VIN_CARFAX_REPORT_EXIST_PATH, $queryParams);
    
        return $this->client->makeResponse($response);
    }
    
    /**
     * @param string $apiKey
     * @param string $vinCode
     *
     * @return array
     */
    private function prepareQueryParams(string $apiKey, string $vinCode): array
    {
        return [
            self::QUERY_PARAM_API_KEY  => $apiKey,
            self::QUERY_PARAM_VIN_CODE => $vinCode
        ];
    }
}
