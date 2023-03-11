<?php
declare(strict_types=1);

namespace CheckVin\Api\Config;

/**
 * Class Config.
 */
class Config
{
    private string $host = 'http://198.199.90.224';
    
    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }
}
