<?php
namespace Yandex\Geo;

use Illuminate\Support\ServiceProvider;

class GeocodeServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__) . '/../../config/yandex-geocoding.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {

            $this->publishes([$source => config_path('yandex-geocoding.php')]);

        } elseif ($this->app instanceof LumenApplication) {

            $this->app->configure('yandex-geocoding');

        }

        $this->mergeConfigFrom($source, 'yandex-geocoding');

    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('yandex-geocoding', function ($app) {

            return new \Yandex\Geo\Api;

        });

        if ($this->app instanceof LaravelApplication) {

            $this->app->booting(function () {

                $loader = \Illuminate\Foundation\AliasLoader::getInstance();

                $loader->alias('YaGeo', 'Yandex\Geo\Facades\Geocode');

            });

        }

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {

        return array();

    }

}
