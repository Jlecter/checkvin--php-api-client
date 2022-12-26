<?php
declare(strict_types=1);

namespace CheckVin\Api\Response\Success\Carfax\VincodeCarfax;

use CheckVin\Api\Response\ApiResponse;

/**
 * Class SuccessResponse.
 */
class SuccessResponse extends ApiResponse
{
    public const SUCCESS_CODE = 200;
    
    private string $vin;
    private string $hash;
    private string $hasCarfax;
    private string $carfaxData;
    private string $updatedAt;
    
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->vin        = (string) $data['vin'];
        $this->hash       = (string) $data['hash'];
        $this->hasCarfax  = (string) $data['has_carfax'];
        $this->carfaxData = (string) $data['carfax_data'];
        $this->updatedAt  = (string) $data['updated_at'];
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
    public function getHash(): string
    {
        return $this->hash;
    }
    
    /**
     * @return string
     */
    public function hasCarfax(): string
    {
        return $this->hasCarfax;
    }
    
    /**
     * @return string
     */
    public function getCarfaxData(): string
    {
        return $this->carfaxData;
    }
    
    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
