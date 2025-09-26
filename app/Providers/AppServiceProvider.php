<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\HouseOwnerRepositoryInterface;
use App\Repositories\Admin\HouseOwnerRepository;
use App\Services\Admin\HouseOwnerServiceInterface;
use App\Services\Admin\HouseOwnerService;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HouseOwnerRepositoryInterface::class, HouseOwnerRepository::class);
        $this->app->bind(HouseOwnerServiceInterface::class, HouseOwnerService::class);
    }

    public function boot()
    {
        Route::aliasMiddleware('role', RoleMiddleware::class);
        Route::aliasMiddleware('permission', PermissionMiddleware::class);
        Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    }
}
