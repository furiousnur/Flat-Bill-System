<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HouseOwnerController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Owner\FlatController;
use App\Http\Controllers\Owner\BillCategoryController;
use App\Http\Controllers\Owner\BillController;
use App\Http\Controllers\Owner\BuildingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('admin')->middleware('role:super-admin')->group(function () {
        Route::resource('house-owners', HouseOwnerController::class)->names('admin.house-owners');
        Route::resource('tenants', TenantController::class)->names('admin.tenants');
    });

    Route::prefix('owner')->middleware('role:house-owner')->group(function () {
        Route::resource('flats', FlatController::class)->names('owner.flats');
        Route::resource('bill-categories', BillCategoryController::class)->names('owner.bill-categories');
        Route::resource('bills', BillController::class)->names('owner.bills');
        Route::resource('buildings', BuildingController::class)->names('owner.buildings');
    });
});

require __DIR__.'/auth.php';
