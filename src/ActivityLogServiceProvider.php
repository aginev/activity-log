<?php

namespace Aginev\ActivityLog;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Aginev\ActivityLog\Exceptions\ActivityLogException;

class ActivityLogServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Call this always before the handler binding
        $this->registerHandlerBinding();

        $this->app->bind('Aginev\ActivityLog', function ($app) {
            return $this->app->make('Aginev\ActivityLog\Handlers\LogActivityInterface');
        });

        // register aliases
        AliasLoader::getInstance()->alias("ActivityLog", ActivityLogFacade::class);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Merge config
        $this->mergeConfigFrom(base_path('vendor/aginev/activity-log/config/activity-log.php'), 'activity-log');
        // Publish config
        $this->publishes([
            base_path('vendor/aginev/activity-log/config/activity-log.php') => config_path('activity-log.php'),
        ], 'config');

        // Publish migrations
        $this->publishes([
            base_path('vendor/aginev/activity-log/migrations/create_user_activities_table.php') => database_path('/migrations/' . date('Y_m_d_His', time()) . '_create_user_activities_table.php'),
        ], 'migrations');
    }

    /**
     * Register handler binding based on config log value
     *
     * @throws ActivityLogException
     */
    private function registerHandlerBinding()
    {
        $this->app->bind(Handlers\LogActivityInterface::class, config('activity-log.log', Handlers\EloquentHandler::class));
    }
}