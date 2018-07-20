<?php

namespace Rslhdyt\LaraSettings;

use Illuminate\Support\Facades\Cache;
use Rslhdyt\LaraSettings\Models\Setting;
use Illuminate\Support\ServiceProvider as IluminateServiceProvider;

class ServiceProvider extends IluminateServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/views', 'larasettings');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/larasettings'),
        ], 'views');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\RegisterSetting::class,
            ]);
        }

        try {
            // set to 1 hour
            $settings = Cache::remember('larasettings', 60, function () {
                return Setting::all()->pluck('value', 'key');
            });

            config($settings->toArray());
        } catch (\PDOException $exception) {
            // do nothing
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/config/settings.php' => config_path('settings.php'),
        ], 'settings');

        $this->mergeConfigFrom(
            __DIR__ . '/config/settings.php',
            'settings'
        );
    }
}
