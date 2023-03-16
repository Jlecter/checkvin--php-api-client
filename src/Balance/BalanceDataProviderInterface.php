<?php
declare(strict_types=1);

namespace CheckVin\Api\Balance;

use CheckVin\Api\Http\Response\Abstraction\ApiResponse;

/**
 * Interface BalanceDataProviderInterface.
 */
interface BalanceDataProviderInterface
{
    /**
     * @return ApiResponse
     */
    public function getBalance(): ApiResponse;
}
