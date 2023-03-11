<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Response\Abstraction;

/**
 * Class ErrorResponse.
 */
abstract class ErrorResponse extends ApiResponse
{
    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return false;
    }
    
    public function getData(): array
    {
        return [];
    }
}
