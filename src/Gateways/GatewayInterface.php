<?php

namespace Nizigama\CurrencyConverter\Gateways;

interface GatewayInterface{

    public function getConversionRate(string $currency): float;
}