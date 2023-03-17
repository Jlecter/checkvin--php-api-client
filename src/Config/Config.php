<?php
declare(strict_types=1);

namespace CheckVin\Api\Config;

/**
 * Class Config.
 */
class Config
{
    private string $host = 'https://apicheckvin.xyz';
    
    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }
}
