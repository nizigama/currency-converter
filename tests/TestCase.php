<?php

namespace Nizigama\CurrencyConverter\Tests;

use Nizigama\CurrencyConverter\CurrencyConverterServiceProvider;

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
    // perform environment setup
  }
}