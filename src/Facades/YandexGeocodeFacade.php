<?php namespace Yandex\Geocode\Facades;

use Illuminate\Support\Facades\Facade;

class YandexGeocodeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yandexGeocoding';
    }
}
