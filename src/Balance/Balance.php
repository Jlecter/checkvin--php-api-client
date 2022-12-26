<?php
declare(strict_types=1);

namespace CheckVin\Api\Balance;

use CheckVin\Api\Response\ApiResponse;
use CheckVin\Api\Response\Error\ErrorResponse;
use CheckVin\Api\Response\Success\Balance\SuccessResponse;
use stdClass;

/**
 * Class Balance.
 */
class Balance
{
    private const PATH = '/api/v1/carfax/balance';
    private const QUERY_PARAM_API_KEY = 'api_key';
    private stdClass $config;
    
    public function __construct()
    {
        $this->config = include(__DIR__ . '/../config/config.php');
    }
    
    /**
     * @param string $apiKey
     *
     * @return ApiResponse
     */
    public function getCarfaxBalance(string $apiKey): ApiResponse
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $this->buildRequestUrl($apiKey));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);

        curl_close($curl);
        
        $decodedOutput = json_decode($output, true);
        
        if (curl_getinfo($curl)['http_code'] !== SuccessResponse::SUCCESS_CODE) {
            return new ErrorResponse($decodedOutput);
        }
        return new SuccessResponse($decodedOutput);
    }
    
    /**
     * @param string $apiKey
     *
     * @return string
     */
    private function buildRequestUrl(string $apiKey): string
    {
        return $this->config->host . self::PATH . '?' . self::QUERY_PARAM_API_KEY . '=' . $apiKey;
    }
}
