<?php
namespace ZiNETHQ\SparkTeamEmail;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ZiNETHQ\SparkTeamEmail\Console\Commands\ValidateInvitationsCommand;

use Carbon\Carbon;

use ZiNETHQ\SparkTeamEmail\SparkTeamEmail;

class SparkTeamEmailServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
            __DIR__.'/../install-stubs/config/sparkteamemail.php',
            'sparkteamemail'
        );

        $this->app->singleton(SparkTeamEmail::class, function ($app) {
            return new SparkTeamEmail();
        });
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
        $publishes[realpath("{$stubs}/config")] = config_path();

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
        return [SparkTeamEmail::class];
    }
}
