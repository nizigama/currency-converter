<?php

use Illuminate\Support\Facades\Route;
use JohnDoe\BlogPackage\Http\Controllers\PostController;
use Nizigama\CurrencyConverter\Http\Controllers\CurrencyConversionController;

Route::prefix("api")->group(function () {
    Route::prefix("v1")->group(function () {

        Route::get("currency-converter/{currency}/{amount}", [CurrencyConversionController::class, "convert"])
            ->whereNumber("amount");
    });
});
