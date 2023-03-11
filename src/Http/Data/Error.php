<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Data;

use CheckVin\Api\Http\Response\ClientResponse;

/**
 * Class Error.
 */
class Error
{
    private string $message;
    
    /**
     * @param ClientResponse $clientResponse
     */
    public function __construct(ClientResponse $clientResponse)
    {
        $this->message = $this->setMessage($clientResponse);
    }
    
    /**
     * @param ClientResponse $clientResponse
     *
     * @return string
     */
    private function setMessage(ClientResponse $clientResponse): string
    {
        $data = $clientResponse->getData();
        $message = (string) $data['message'];
        
        if (array_key_exists('errors', $data)) {
            array_walk_recursive($data['errors'], function($value) use (&$message) {
                $message = $message . ' ' . $value;
            });
        }
        
        return $message;
    }
    
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
