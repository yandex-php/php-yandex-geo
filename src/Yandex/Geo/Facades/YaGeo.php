<?php
namespace Jcf\Geocode\Facades;

use Illuminate\Support\Facades\Facade;

class Geocode extends Facade
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
