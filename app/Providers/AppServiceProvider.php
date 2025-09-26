<?php

namespace App\Providers;

use App\Models\HouseOwner;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\HouseOwnerRepositoryInterface;
use App\Repositories\Admin\HouseOwnerRepository;
use App\Repositories\Admin\Tenant\TenantRepository;
use App\Repositories\Admin\Tenant\TenantRepositoryInterface;
use App\Repositories\Owner\Bill\BillRepository;
use App\Repositories\Owner\Bill\BillRepositoryInterface;
use App\Repositories\Owner\BillCategories\BillCategoriesRepository;
use App\Repositories\Owner\BillCategories\BillCategoriesRepositoryInterface;
use App\Repositories\Owner\Building\BuildingRepository;
use App\Repositories\Owner\Building\BuildingRepositoryInterface;
use App\Repositories\Owner\Flat\FlatRepository;
use App\Repositories\Owner\Flat\FlatRepositoryInterface;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HouseOwnerRepositoryInterface::class, HouseOwnerRepository::class);
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
        $this->app->bind(BuildingRepositoryInterface::class, BuildingRepository::class);
        $this->app->bind(FlatRepositoryInterface::class, FlatRepository::class);
        $this->app->bind(BillCategoriesRepositoryInterface::class, BillCategoriesRepository::class);
        $this->app->bind(BillRepositoryInterface::class, BillRepository::class);
    }

    public function boot()
    {
        Route::model('house_owner', HouseOwner::class);

        Route::aliasMiddleware('role', RoleMiddleware::class);
        Route::aliasMiddleware('permission', PermissionMiddleware::class);
        Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    }
}
