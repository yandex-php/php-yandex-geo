# Laravel Yandex Geocodig
Simply service laravel Yandex Geocoding

## Installation 

Run composer require command.

```sh
composer require jack/laravel-yandex-geocode
```

### Laravel install

After updating composer, register the service provider in bootstrap\app.php
```php
Yandex\Geo\YandexServiceProvider::class
```

Add then alias YaGeo adding its facade to the aliases array in the same file:

```php
'YaGeo' => Yandex\Geo\YandexServiceProvider::class
```

## Configuration


## Usage