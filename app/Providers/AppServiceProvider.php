<?php

namespace App\Providers;

use Awcodes\Curator\Facades\Curator;
use Illuminate\Support\ServiceProvider;
use Z3d0X\FilamentFabricator\Resources\PageResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PageResource::navigationGroup('Páginas');
        PageResource::navigationIcon('heroicon-o-template');
        // Curator::shouldRegisterNavigation('Páginas');
    }
}
