<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Client;

use CheckVin\Api\Config\Config;
use CheckVin\Api\Http\Response\Abstraction\ApiResponse;
use CheckVin\Api\Http\Response\ClientResponse;
use CheckVin\Api\Http\Response\Error\ApplicationErrorResponse;
use CheckVin\Api\Http\Response\Success\ApplicationSuccessResponse;

/**
 * Class Client.
 */
class Client implements ClientInterface
{
    private Config $config;
    
    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    /**
     * @param string $path
     * @param array  $params
     *
     * @return ClientResponse
     */
    public function request(string $path, array $params): ClientResponse
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->buildRequestUrl($path, $params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $output = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            throw new \LogicException('Request failed. Message: '. curl_error($curl));
        }
    
        $response = new ClientResponse(json_decode($output, true), curl_getinfo($curl)['http_code']);
        curl_close($curl);

        return $response;
    }
    
    /**
     * @param ClientResponse $clientResponse
     *
     * @return ApiResponse
     */
    public function makeResponse(ClientResponse $clientResponse): ApiResponse
    {
        if ($clientResponse->getResponseHttpCode() !== ApplicationSuccessResponse::SUCCESS_CODE) {
            return new ApplicationErrorResponse($clientResponse);
        }
        
        return new ApplicationSuccessResponse($clientResponse);
    }
    
    /**
     * @param string $path
     * @param array  $params
     *
     * @return string
     */
    private function buildRequestUrl(string $path, array $params): string
    {
        return $this->config->getHost() . $path . '?' . http_build_query($params);
    }
}
