<?php
declare(strict_types=1);

namespace CheckVin\Api\Carfax;

use CheckVin\Api\Config\ApiUriGlossary;
use CheckVin\Api\Http\Client;
use CheckVin\Api\Http\Response\Abstraction\ApiResponse;
use CheckVin\Api\Http\Response\ClientResponse;
use CheckVin\Api\Http\Response\Error\ApplicationErrorResponse;
use CheckVin\Api\Http\Response\Success\ApplicationSuccessResponse;

/**
 * Class Carfax.
 */
class Carfax
{
    private const QUERY_PARAM_API_KEY = 'api_key';
    private const QUERY_PARAM_VIN_CODE = 'vincode';
    private string $apiKey;
    private Client $client;
    
    public function __construct(string $apiKey, Client $client)
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
    
        return $this->makeResponse($response);
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
    
        return $this->makeResponse($response);
    }
    
    /**
     * @param ClientResponse $clientResponse
     *
     * @return ApiResponse
     */
    private function makeResponse(ClientResponse $clientResponse): ApiResponse
    {
        if ($clientResponse->getCurlHttpCode() !== ApplicationSuccessResponse::SUCCESS_CODE) {
            return new ApplicationErrorResponse($clientResponse);
        }
        
        return new ApplicationSuccessResponse($clientResponse);
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
