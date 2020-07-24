<?php

namespace SoluzioneSoftware\Laravel\OpenGraph;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use SoluzioneSoftware\Laravel\OpenGraph\Contracts\OpenGraphData as OpenGraphDataContract;
use SoluzioneSoftware\Laravel\OpenGraph\Models\OpenGraphData;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerManager();
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->bootMigrations();
    }

    private function bootMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/' => App::databasePath('migrations')
        ], ['migrations', 'open-graph', 'open-graph-migrations']);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function registerBindings()
    {
        $this->app->bind(OpenGraphDataContract::class, OpenGraphData::class);
    }

    protected function registerManager()
    {
        $this->app->singleton('open_graph.manager', function () {
            return new Manager();
        });
    }
}
