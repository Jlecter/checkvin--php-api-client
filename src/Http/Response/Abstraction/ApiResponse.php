<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Response\Abstraction;

use CheckVin\Api\Http\Data\Error;

/**
 * Class ApiResponse.
 */
abstract class ApiResponse
{
    /**
     * @return bool
     */
    abstract public function isSuccess(): bool;
    
    /**
     * @return null|Error
     */
    abstract public function getError(): ?Error;
    
    /**
     * @return array
     */
    abstract public function getData(): array;
}
