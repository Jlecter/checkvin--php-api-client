<?php
declare(strict_types=1);

namespace CheckVin\Api\Http\Response;

/**
 * Class ClientResponse.
 */
class ClientResponse
{
    private array $data;
    private int $httpCode;
    
    /**
     * @param array $data
     * @param int   $httpCode
     */
    public function __construct(array $data, int $httpCode)
    {
        $this->data = $data;
        $this->httpCode = $httpCode;
    }
    
    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
    
    /**
     * @return int
     */
    public function getResponseHttpCode(): int
    {
        return $this->httpCode;
    }
}
