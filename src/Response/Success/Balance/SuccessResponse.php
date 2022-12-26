<?php
declare(strict_types=1);

namespace CheckVin\Api\Response\Success\Balance;

use CheckVin\Api\Response\ApiResponse;

/**
 * Class SuccessResponse.
 */
class SuccessResponse extends ApiResponse
{
    public const SUCCESS_CODE = 200;
    
    private string $balance;
    
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->balance = (string) $data['message'];
    }
    
    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }
}
