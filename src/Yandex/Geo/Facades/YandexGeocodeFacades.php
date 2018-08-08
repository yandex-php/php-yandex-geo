<?php
namespace Yandex\Geo\Facades;

use Illuminate\Support\Facades\Facade;

class YandexGeocodeFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'yandexGeocoding';

    }

}
