<?php

declare(strict_types=1);

namespace Nizigama\CurrencyConverter\Facades;

use Illuminate\Support\Facades\Facade;

class Converter extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'currency_converter';
    }

}