<?php
namespace Yandex\Geo\Facades;

use Illuminate\Support\Facades\Facade;

class YaGeo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'yandex-geocoding';

    }

}
