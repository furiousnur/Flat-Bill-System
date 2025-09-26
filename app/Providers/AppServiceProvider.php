<?php

namespace App\Providers;

use App\Models\HouseOwner;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\HouseOwnerRepositoryInterface;
use App\Repositories\Admin\HouseOwnerRepository;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HouseOwnerRepositoryInterface::class, HouseOwnerRepository::class);
    }

    public function boot()
    {
        Route::model('house_owner', HouseOwner::class);

        Route::aliasMiddleware('role', RoleMiddleware::class);
        Route::aliasMiddleware('permission', PermissionMiddleware::class);
        Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    }
}
