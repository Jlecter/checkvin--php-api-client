<?php
declare(strict_types=1);

namespace CheckVin\Api\Autocheck;

use CheckVin\Api\Response\ApiResponse;
use CheckVin\Api\Response\Error\ErrorResponse;
use CheckVin\Api\Response\Success\Autocheck\CheckReportExists\SuccessResponse as ReportExistsSuccessResponse;
use CheckVin\Api\Response\Success\Autocheck\VincodeAutocheck\SuccessResponse as VincodeAutocheckSuccessResponse;
use stdClass;

/**
 * Class Autocheck.
 */
class Autocheck
{
    private const VIN_AUTOCHECK_PATH = '/api/v1/autocheck';
    private const VIN_REPORT_EXIST_PATH = '/api/v1/autocheck/check';
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
    public function getAutoCheckForVinCode(string $apiKey, string $vinCode): ApiResponse
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $this->buildAutoCheckForVinCodeRequestUrl($apiKey, $vinCode));
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $output = curl_exec($curl);

        curl_close($curl);
        
        $decodedOutput = json_decode($output, true);
        
        if (curl_getinfo($curl)['http_code'] !== VincodeAutocheckSuccessResponse::SUCCESS_CODE) {
            return new ErrorResponse($decodedOutput);
        }
        
        return new VincodeAutocheckSuccessResponse($decodedOutput);
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
    private function buildAutoCheckForVinCodeRequestUrl(string $apiKey, string $vinCode): string
    {
        return $this->config->host . self::VIN_AUTOCHECK_PATH . '?' . self::QUERY_PARAM_API_KEY . '=' . $apiKey
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
