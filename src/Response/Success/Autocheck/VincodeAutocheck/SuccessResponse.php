<?php
declare(strict_types=1);

namespace CheckVin\Api\Response\Success\Autocheck\VincodeAutocheck;

use CheckVin\Api\Response\ApiResponse;

/**
 * Class SuccessResponse.
 */
class SuccessResponse extends ApiResponse
{
    public const SUCCESS_CODE = 200;
    
    private string $vin;
    private string $hasAutocheck;
    private string $autocheckData;
    private string $updatedAt;
    
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->vin           = (string) $data['vin'];
        $this->hasAutocheck  = (string) $data['has_autocheck'];
        $this->autocheckData = (string) $data['autocheck_data'];
        $this->updatedAt     = (string) $data['updated_at'];
    }
    
    /**
     * @return string
     */
    public function getVin(): string
    {
        return $this->vin;
    }
    
    /**
     * @return string
     */
    public function hasAutocheck(): string
    {
        return $this->hasAutocheck;
    }
    
    /**
     * @return string
     */
    public function getAutocheckData(): string
    {
        return $this->autocheckData;
    }
    
    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
