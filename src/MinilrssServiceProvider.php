<?php
namespace Tanjibo\Mini;


use Illuminate\Support\ServiceProvider;
use Tanjibo\Minilrss\Minilrss;

class MinilrssServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $config_file = __DIR__ . '/../config/config.php';

        $this->mergeConfigFrom($config_file, 'Minilrss');

        $this->publishes([
            $config_file => config_path('minilrss.php')
        ], 'minilrss');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('minilrss', function ()
        {
            return new Minilrss();
        });

        $this->app->alias('minilrss', Minilrss::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['minilrss', Minilrss::class];
    }
}
