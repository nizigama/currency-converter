<?php

declare(strict_types=1);

namespace Nizigama\CurrencyConverter;

use Illuminate\Support\ServiceProvider;
use Nizigama\CurrencyConverter\Gateways\CentralBankConversionGateway;

class CurrencyConverterServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('currency_converter', function($app) {
            return new CurrencyConverter("eur", new CentralBankConversionGateway());
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'currencyconverter');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
              __DIR__.'/../config/config.php' => config_path('currency-converter.php'),
            ], 'config');
        
          }

          $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
