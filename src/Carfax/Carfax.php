<?php
declare(strict_types=1);

namespace CheckVin\Api\Carfax;

use CheckVin\Api\Response\ApiResponse;
use CheckVin\Api\Response\Error\ErrorResponse;
use CheckVin\Api\Response\Success\Carfax\CheckReportExists\SuccessResponse as ReportExistsSuccessResponse;
use CheckVin\Api\Response\Success\Carfax\VincodeCarfax\SuccessResponse as VincodeCarfaxSuccessResponse;
use stdClass;

/**
 * Class Carfax.
 */
class Carfax
{
    private const VIN_CARFAX_PATH = '/api/v1/carfax';
    private const VIN_REPORT_EXIST_PATH = '/api/v1/carfax/check';
    private const QUERY_PARAM_API_KEY = 'api_key';
    private const QUERY_PARAM_VIN_CODE = 'vincode';
    private stdClass $config;
    
    public function __construct()
    {
        $this->config = include(__DIR__ . '/../config/config.php');
    }
    
    /**
     * @param string $apiKey
     * @param string $vinCode
     *
     * @return ApiResponse
     */
    public function getCarfaxForVinCode(string $apiKey, string $vinCode): ApiResponse
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $this->buildCarfaxForVinCodeRequestUrl($apiKey, $vinCode));
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $output = curl_exec($curl);

        curl_close($curl);
        
        $decodedOutput = json_decode($output, true);
        
        if (curl_getinfo($curl)['http_code'] !== VincodeCarfaxSuccessResponse::SUCCESS_CODE) {
            return new ErrorResponse($decodedOutput);
        }
        
        return new VincodeCarfaxSuccessResponse($decodedOutput);
    }
    
    /**
     * @param string $apiKey
     * @param string $vinCode
     *
     * @return ApiResponse
     */
    public function checkReportExists(string $apiKey, string $vinCode): ApiResponse
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $this->buildVinCodeReportExistRequestUrl($apiKey, $vinCode));
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $output = curl_exec($curl);
        
        curl_close($curl);
        
        $decodedOutput = json_decode($output, true);
        
        if (curl_getinfo($curl)['http_code'] !== ReportExistsSuccessResponse::SUCCESS_CODE) {
            return new ErrorResponse($decodedOutput);
        }
        
        return new ReportExistsSuccessResponse($decodedOutput);
    }
    
    /**
     * @param string $apiKey
     * @param string $vinCode
     *
     * @return string
     */
    private function buildCarfaxForVinCodeRequestUrl(string $apiKey, string $vinCode): string
    {
        return $this->config->host . self::VIN_CARFAX_PATH . '?' . self::QUERY_PARAM_API_KEY . '=' . $apiKey
            . '&' . self::QUERY_PARAM_VIN_CODE . '=' . $vinCode;
    }
    
    /**
     * @param string $apiKey
     * @param string $vinCode
     *
     * @return string
     */
    private function buildVinCodeReportExistRequestUrl(string $apiKey, string $vinCode): string
    {
        return $this->config->host . self::VIN_REPORT_EXIST_PATH . '?' . self::QUERY_PARAM_API_KEY . '=' . $apiKey
            . '&' . self::QUERY_PARAM_VIN_CODE . '=' . $vinCode;
    }
}
