<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Response\Abstraction;

use CheckVin\Api\Http\Data\Error;

/**
 * Class SuccessResponse.
 */
abstract class SuccessResponse extends ApiResponse
{
    public const SUCCESS_CODE = 200;
    
    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return true;
    }
    
    public function getError(): ?Error
    {
        return null;
    }
}
