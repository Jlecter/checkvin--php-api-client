<?php
declare(strict_types=1);

namespace CheckVin\Api\Response\Error;

use CheckVin\Api\Response\ApiResponse;

/**
 * Class ErrorResponse.
 */
class ErrorResponse extends ApiResponse
{
    private string $message;
    private ?array $errors;
    
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->message = $data['message'];
        $this->errors = array_key_exists('errors', $data) ? $data['errors'] : null;
    }
    
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    
    /**
     * @return null|array
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
