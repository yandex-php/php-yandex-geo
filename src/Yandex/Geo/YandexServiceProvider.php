<?php
namespace Yandex\Geo;

use Illuminate\Contracts\Container\Container as Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Yandex\Geo\Api;

class YandexServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {

        $this->setupConfig(

            $this->app

        );

    }
    /**
     *
     * Setup the config
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     *
     */
    protected function setupConfig(Application $app)
    {

        $source = __DIR__ . '/config/yandex-geocoding.php';

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

        $this->registerManager(

            $this->app

        );

    }
    /**
     *
     * Registrer the manager class
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     *
     */
    protected function registerManager(Application $app)
    {

        $this->app->singleton('yandex-geocoding', function ($app) {

            $config = (array) $app['config']['yandex-geocoding'];

            return (new Api($config));

        });

        $app->alias('YaGeo', Api::class);

    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {

        return ['yandex-geocoding', Api::class];

    }

}
