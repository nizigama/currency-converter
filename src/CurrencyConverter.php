<?php

declare(strict_types=1);

namespace Nizigama\CurrencyConverter;

use Exception;
use Nizigama\CurrencyConverter\Gateways\GatewayInterface;

class CurrencyConverter
{

    protected string $currency;
    protected GatewayInterface $gatewayInterface;

    public function __construct(string $currency, GatewayInterface $gatewayInterface)
    {
        $this->currency = $currency;
        $this->gatewayInterface = $gatewayInterface;
    }

    /**
     * Get converted amount in USD
     * @var float $amount
     * @throws Exception in case it failed to reach the Central Bank API
     */
    public function inUSD(float $amount): float
    {
        $rate = $this->gatewayInterface->getConversionRate("usd");
        return $amount * $rate;
    }

    /**
     * Get conversion rate in provided currency from Euro
     * @var string $currency
     * @return float $rate
     * @throws Exception in case it failed to get conversion rate from Central Bank API
     */
    public function getRate(string $currency): float
    {
        $rate = $this->gatewayInterface->getConversionRate($currency);
        return $rate;
    }

    /**
     * Get converted amount from Euro to given currency
     * @var string $currency
     * @return float $amount
     * @return float $result
     * @throws Exception in case it failed to reach the Central Bank API
     */
    public function exchange(string $currency, float $amount): float
    {
        $rate = $this->gatewayInterface->getConversionRate($currency);
        return round($amount * $rate, 2);
    }
}
