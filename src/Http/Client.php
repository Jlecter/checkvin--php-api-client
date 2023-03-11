<?php
declare(strict_types=1);

namespace CheckVin\Api\Http;

use CheckVin\Api\Config\Config;
use CheckVin\Api\Http\Response\ClientResponse;

/**
 * Class Client.
 */
class Client
{
    private Config $config;
    
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
    
        curl_close($curl);
    
        return new ClientResponse(json_decode($output, true), curl_getinfo($curl)['http_code']);
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
