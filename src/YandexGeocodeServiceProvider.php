<?php namespace Yandex\Geocode;

use Illuminate\Support\ServiceProvider;

class YandexGeocodeServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        $configPath = __DIR__ . '/config/yandex-geocoding.php';

        $this->publishes([$configPath => config_path('yandex-geocoding.php')], 'yandex-geocoding-config');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('yandexGeocoding', function () {

            return new \Yandex\Geocode\Api;
        });

    }

}
