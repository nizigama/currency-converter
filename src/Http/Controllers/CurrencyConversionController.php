<?php

namespace Nizigama\CurrencyConverter\Http\Controllers;

use Nizigama\CurrencyConverter\Facades\Converter;

class CurrencyConversionController extends Controller
{
    public function convert(string $currency, int $amount)
    {
        $converter = Converter::getRate($currency);
        $convertedAmount = $converter->exchange($amount);

        return response()->json(["amount" => $convertedAmount, "rate" => $converter->rate]);
    }
}
