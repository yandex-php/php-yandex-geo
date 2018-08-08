<?php
namespace Yandex\Geo;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class YandexServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var BOOL
     *
     */
    protected $defer = true;

    /**
     * Bootstrap the configuration
     *
     * @return VOID
     *
     */
    public function boot()
    {

        $source = __DIR__ . '/config/yandex-geocoding.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {

            $this->publishes(

                [$source => config_path('yandex-geocoding.php')],
                'yandex-geocode-config'

            );

        } elseif ($this->app instanceof LumenApplication) {

            $this->app->configure('yandexGeocoding');

        }

    }
    /**
     * Register the service provider.
     *
     * @return VOID
     *
     */
    public function register()
    {

        $this->app->bind('yandexGeocoding', function () {

            return new \Yandex\Geo\Api;

        });

    }

}
