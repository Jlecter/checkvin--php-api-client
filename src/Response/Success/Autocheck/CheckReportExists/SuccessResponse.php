<?php
declare(strict_types=1);

namespace CheckVin\Api\Response\Success\Autocheck\CheckReportExists;

use CheckVin\Api\Response\ApiResponse;

/**
 * Class SuccessResponse.
 */
class SuccessResponse extends ApiResponse
{
    public const SUCCESS_CODE = 200;
    
    private string $message;
    
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->message = (string) $data['message'];
    }
    
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
