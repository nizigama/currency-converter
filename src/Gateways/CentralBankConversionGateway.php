<?php

declare(strict_types=1);

namespace Nizigama\CurrencyConverter\Gateways;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class CentralBankConversionGateway implements GatewayInterface
{
    /** @throws Exception */
    public function getConversionRate(string $currency): float
    {

        $url = Config::get("currency-converter.european_central_bank_conversion_api");

        $conversionRatesRequest = Http::get($url);

        if ($conversionRatesRequest->failed()) {
            throw new Exception("Failed to fetch conversion rates");
        }

        $rates = $conversionRatesRequest->body();

        $data = simplexml_load_string($rates);

        
        $json = json_encode($data);
        $array = json_decode($json, true);
        $currenciesData = $array["Cube"]["Cube"]["Cube"];

        $data = [];
        foreach($currenciesData as $currencyData){
            $data[$currencyData["@attributes"]["currency"]] = floatval($currencyData["@attributes"]["rate"]);
        }

        if(!in_array(strtoupper($currency),array_keys($data))){
            throw new Exception("Unsupported currency");
        }

        return $data[strtoupper($currency)];
    }
}
