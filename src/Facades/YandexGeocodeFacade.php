<?php namespace Yandex\Geo;

use Illuminate\Support\Facades\Facade;

class YandexGeocodeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yandexGeocoding';
    }
}
