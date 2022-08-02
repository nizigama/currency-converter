<?php

namespace Nizigama\CurrencyConverter\Http\Controllers;

use Nizigama\CurrencyConverter\Facades\Converter;

class CurrencyConversionController extends Controller
{
    public function convert(?string $currency = null, int $amount)
    {
        $convertedAmount = Converter::exchange($currency, $amount);

        return response()->json(["amount" => $convertedAmount]);
    }
}
