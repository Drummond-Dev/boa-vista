<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\PermissionResource;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            if (auth()->user()) {
                if (auth()->user()->is_admin === 1 && auth()->user()->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
                    Filament::registerUserMenuItems([
                        UserMenuItem::make()
                            ->label('Usuários')
                            ->url(UserResource::getUrl())
                            ->icon('heroicon-s-user-group'),
                        UserMenuItem::make()
                            ->label('Regras')
                            ->url(RoleResource::getUrl())
                            ->icon('heroicon-s-finger-print'),
                        UserMenuItem::make()
                            ->label('Permissões')
                            ->url(PermissionResource::getUrl())
                            ->icon('heroicon-s-key'),
                    ]);
                }
            }

            Filament::registerNavigationGroups([
                'Prefeitura',
                'Canal do Cidadão',
                'Cultura',
                'Notícias',
                'Navegação',
                'Administrativo',
            ]);
        });
    }
}
