<?php

declare(strict_types=1);

namespace Nizigama\CurrencyConverter;

use Exception;
use Nizigama\CurrencyConverter\Gateways\GatewayInterface;

class CurrencyConverter
{

    protected string $currency;
    public float $rate;
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
    public function getRate(string $currency): self
    {
        $this->currency = $currency;
        $this->rate = $this->gatewayInterface->getConversionRate($currency);
        return $this;
    }

    /**
     * Get converted amount from Euro to given currency
     * @var string $currency
     * @return float $amount
     * @return float $result
     * @throws Exception in case it failed to reach the Central Bank API or when no currency was provided
     */
    public function exchange(float $amount, ?string $currency = null): float
    {
        if (is_null($currency) && is_null($this->currency)) {
            throw new Exception("No currency found");
        }
        $rate = $this->gatewayInterface->getConversionRate($currency ?? $this->currency);
        return round($amount * $rate, 2);
    }
}
