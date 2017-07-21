<?php
namespace ZiNETHQ\SparkUserTeamEmail;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

use Carbon\Carbon;

use ZiNETHQ\SparkUserTeamEmail\SparkUserTeamEmail;

class SparkUserTeamEmailServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $commands = [];

    /**
     * Boot the service provider
     *
     * @return null
     */
    public function boot()
    {
        $this->publish();
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../install-stubs/config/sparkuserteamemail.php',
            'sparkuserteamemail'
        );

        $this->app->singleton(SparkUserTeamEmail::class, function ($app) {
            return new SparkUserTeamEmail();
        });

        $this->commands($this->commands);
    }

    /**
     * Construct the array of files to publish
     *
     * @return void
     */
    protected function publish()
    {
        $publishes = [];
        $date = Carbon::now();
        $stubs = __DIR__.'/../install-stubs';

        foreach ($this->getMigrations() as $key => $migration) {
            $exists = glob(database_path("/migrations/*_{$migration}.php"));
            $timestamp = $date->addSeconds($key)->format('Y_m_d_His');
            $filename = ($exists && count($exists) === 1) ? $exists[0] : database_path("migrations/{$timestamp}_{$migration}.php");
            $publishes["{$stubs}/database/migrations/{$migration}.php"] = $filename;
        }
        $publishes["{$stubs}/config"] = config_path();

        $this->publishes($publishes);
    }

    /**
     * Get the appropriate migration files in the correct order to be applied
     *
     * @return array
     */
    protected function getMigrations()
    {
        return [
            'add_email_to_team_users_table'
        ];
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SparkUserTeamEmail::class];
    }
}
