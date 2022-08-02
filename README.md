# currency-converter
Laravel package that provides a gateway to the European central bank currency conversion API

### Installation
```bash
composer require nizigama/currency-converter
```

### Publish configs
```bash
php artisan vendor:publish --provider="Nizigama\CurrencyConverter\CurrencyConverterServiceProvider" --tag="config"
```

And Voila! :)
