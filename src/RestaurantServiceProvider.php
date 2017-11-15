<?php

namespace TakeawayTown\LaravelRestaurant;

use Illuminate\Support\ServiceProvider;

class RestaurantServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigration();
    }

    /**
     * Publish Teamwork configuration
     */
    protected function publishConfig()
    {
        if (function_exists('config_path')) {
            $this->publishes([
                realpath(__DIR__ . '/../config/config.php') => config_path('restaurant.php'),
            ]);
        }
    }

    /**
     * Publish Teamwork migration
     */
    protected function publishMigration()
    {
        if (! class_exists('RestaurantSetupTables')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/restaurant_setup_tables.php.stub' => database_path('migrations/'.$timestamp.'_restaurant_setup_tables.php'),
              ], 'migrations');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerRestaurant();
        $this->registerFacade();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    protected function registerRestaurant()
    {
        $this->app->bind('restaurant', function($app) {
            return new Restaurant($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade() {
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Restaurant', 'TakeawayTown\LaravelRestaurant\Facades\Restaurant');
        });
    }

    /**
     * Merges user's and restaurant's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'restaurant'
        );
    }
}
