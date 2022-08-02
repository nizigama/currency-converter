<?php

declare(strict_types=1);

namespace Nizigama\CurrencyConverter\Tests\Unit;

use Illuminate\Support\Facades\Http;
use Nizigama\CurrencyConverter\Gateways\CentralBankConversionGateway;
use Nizigama\CurrencyConverter\Tests\TestCase;

class CentralBankConversionGatewayTest extends TestCase
{


    public function setUp(): void
    {
        parent::setUp();

        $body = '<?xml version="1.0" encoding="UTF-8"?>
      <gesmes:Envelope xmlns:gesmes="http://www.gesmes.org/xml/2002-08-01" xmlns="http://www.ecb.int/vocabulary/2002-08-01/eurofxref">
          <gesmes:subject>Reference rates</gesmes:subject>
          <gesmes:Sender>
              <gesmes:name>European Central Bank</gesmes:name>
          </gesmes:Sender>
          <Cube>
              <Cube time="2022-08-01">
                  <Cube currency="USD" rate="1.0233"/>
                  <Cube currency="JPY" rate="135.38"/>
                  <Cube currency="BGN" rate="1.9558"/>
                  <Cube currency="CZK" rate="24.628"/>
                  <Cube currency="DKK" rate="7.4457"/>
                  <Cube currency="GBP" rate="0.83700"/>
                  <Cube currency="HUF" rate="401.35"/>
                  <Cube currency="PLN" rate="4.7340"/>
                  <Cube currency="RON" rate="4.9283"/>
                  <Cube currency="SEK" rate="10.3668"/>
                  <Cube currency="CHF" rate="0.9717"/>
                  <Cube currency="ISK" rate="138.70"/>
                  <Cube currency="NOK" rate="9.8638"/>
                  <Cube currency="HRK" rate="7.5210"/>
                  <Cube currency="TRY" rate="18.3475"/>
                  <Cube currency="AUD" rate="1.4535"/>
                  <Cube currency="BRL" rate="5.2723"/>
                  <Cube currency="CAD" rate="1.3076"/>
                  <Cube currency="CNY" rate="6.9105"/>
                  <Cube currency="HKD" rate="8.0329"/>
                  <Cube currency="IDR" rate="15203.21"/>
                  <Cube currency="ILS" rate="3.4546"/>
                  <Cube currency="INR" rate="80.9335"/>
                  <Cube currency="KRW" rate="1333.30"/>
                  <Cube currency="MXN" rate="20.7635"/>
                  <Cube currency="MYR" rate="4.5568"/>
                  <Cube currency="NZD" rate="1.6160"/>
                  <Cube currency="PHP" rate="56.734"/>
                  <Cube currency="SGD" rate="1.4087"/>
                  <Cube currency="THB" rate="36.977"/>
                  <Cube currency="ZAR" rate="16.8613"/>
              </Cube>
          </Cube>
      </gesmes:Envelope>';

        Http::fake([
            "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml" => Http::response($body),
        ]);
    }

    /** @test */
    public function can_get_conversion_rate_from_european_central_bank(): void
    {

        $centralBankGateway = new CentralBankConversionGateway();

        $rate = $centralBankGateway->getConversionRate("usd");

        $this->assertIsFloat($rate);

        $this->assertSame(1.0233, $rate);
    }
}
