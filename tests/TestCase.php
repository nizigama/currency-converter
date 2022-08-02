<?php

namespace Nizigama\CurrencyConverter\Tests;

use Illuminate\Support\Facades\Config;
use Nizigama\CurrencyConverter\CurrencyConverterServiceProvider;
use Orchestra\Testbench\Concerns\CreatesApplication;

class TestCase extends \Orchestra\Testbench\TestCase
{

  public function setUp(): void
  {
    parent::setUp();
  }

  protected function getPackageProviders($app)
  {
    return [
      CurrencyConverterServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    Config::set('currency-converter.european_central_bank_conversion_api', env('CENTRAL_BANK_API', null));
  }
}
