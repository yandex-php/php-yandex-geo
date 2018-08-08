# Laravel Yandex Geocodig
Simply service laravel Yandex Geocoding

## Installation 

Run composer require command.

```sh
composer require jackmartin/laravel-yandex-geocode
```

### Laravel Setting

After updating composer, register the service provider in bootstrap\app.php
```php
Yandex\Geo\YandexServiceProvider::class
```

Add then alias YaGeo adding its facade to the aliases array in the same file:

```php
'YaGeo' => Yandex\Geo\Facades\YandexGeocodeFacades::class
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

##Methods

1. Get raw data response
    *
2. Get data response
    *
3. Get name country
    *
4. Get name region
    *
5. Get name district
    *
6. Get name locality
    *
7. Get name street
    *
8. Get house number
    *
9. Get full raw address
    *
10. Get full address
    *
11. Get latitude
    *
12. Get longitude
    *
13. Get type
    *


# Laravel Яндекс Геокодирование

Простой сервис laravel Яндекс Геокодирование

## Установка

Установить пакет с помощью composer

```sh
composer require jackmartin/laravel-yandex-geocode
```

### Laravel настройка пакета

После установки пакета с помощью composer, зарегистрируйте сервис пакета в файле bootstrap/app.php:

```php
Yandex\Geo\YandexServiceProvider::class
```

Затем для быстрого вызов класса пакета, добавьте псевдоним в этот же файле:

```php
'YaGeo' => Yandex\Geo\Facades\YandexGeocodeFacades::class
```

### Lumen настройка пакета

После установки пакета с помощью composer, зарегистрируйте сервис пакета в файле bootstrap/app.php:

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
```
##Методы

1. Получить сырые данные ответа
    *
2. Получить данные ответа 
    *
3. Получить имя страны
    *
4. Получить имя области
    *
5. Получить имя района
    *
6. Получить имя населенного пункта
    *
7. Получить имя улицы
    *
8. Получить номер дома
    *
9. Получить полный сырой адрес
    *
10. Получить полный адрес
    *
11. Получить широту
    *
12. Получить долготу
    *
13. Получить тип
    *

#Methods - Методы:

### getRawData ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getRawData();
```
### getData() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getData();
```
### getCountry() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getCountry();
```
### getRegion() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getCountry();
```
### getDistrict() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getDistrict();
```
### getLocality() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getLocality();
```
### getStreet() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getStreet();
```
### getHouseNumber() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getHouseNumber();
```
### getRawFullAddress() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getRawFullAddress();
```
### getFullAddress() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getFullAddress();
```
### getLatitude() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getLatitude();
```
### getLongitude() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getLongitude();
```
### getType() ###
```php
use YaGeo;
$data = YaGeo::setQuery('Kiev, Vishnevoe, Lesi Ukrainki, 57')->load();
$data = $data->getResponse()->getType();
```