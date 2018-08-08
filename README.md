# Laravel Yandex Geocodig
Simply service laravel Yandex Geocoding

## Installation 

Run composer require command.

```sh
composer require jack/laravel-yandex-geocode
```

### Laravel Setting

After updating composer, register the service provider in bootstrap\app.php
```php
Yandex\Geo\YandexServiceProvider::class
```

Add then alias YaGeo adding its facade to the aliases array in the same file:

```php
'YaGeo' => Yandex\Geo\YandexServiceProvider::class
```

### Lumen Setting

After updating composer, register the service provider in bootstrap/app.php

```php
$app->register(Yandex\Geo\YandexServiceProvider::class);
```

## Configuration parameters package

Api page: https://tech.yandex.ru/maps/doc/geocoder/desc/concepts/input_params-docpage/

#### Api key

```php
'api_key' => ''
```

#### Api version

```php
'api_version' => '1.x'
```

#### Language api response

```php
'language' => 'uk_UA'
```

#### Skip object in query

```php
'skip_object' => 0
```

## Usage

```php
dd(

    \YaGeo::make()->setQuery('Ukraine, Kiev')->load()

);
```
# Laravel Яндекс Геокодирования

Простой сервис laravel Яндекс Геокодирования

## Установка

Установить пакет с помощью composer

```sh
composer require jack/laravel-yandex-geocode
```

### Laravel настройка пакета

После установки пакета с помощью composer, зарегистрируйте сервис пакета в файле boostrap/app.php:

```php
Yandex\Geo\YandexServiceProvider::class
```

Затем для быстрого вызов класса пакета, добавьте псевдоним в этот же файле:

```php
'YaGeo' => Yandex\Geo\YandexServiceProvider::class
```

### Lumen настройка пакета

После установки пакета с помощью composer, зарегистрируйте сервис пакета в файле boostrap/app.php:

```php
Yandex\Geo\YandexServiceProvider::class
```

## Настройка параметров пакета

Документация: https://tech.yandex.ru/maps/doc/geocoder/desc/concepts/input_params-docpage/

#### Ключ API

```php
'api_key' => ''
```

#### API версия

```php
'api_version' => '1.x'
```

#### Язык ответа

```php
'language' => 'uk_UA'
```

#### Количество пропускаемых объектов в запросе

```php
'skip_object' => 0
```

## Использование

```php
dd(

    \YaGeo::make()->setQuery('Украина, Киев')->load()

);
