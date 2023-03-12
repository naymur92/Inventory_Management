<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinishModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\RawMaterialRequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
  // Home
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  // Users
  Route::resource('users', UserController::class);

  // permissions
  Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
  Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
  Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

  // roles
  Route::resource('roles', RoleController::class);

  // Raw Materials
  Route::resource('/raw-materials', RawMaterialController::class);
  Route::post('/raw-materials/get-item-types', [RawMaterialController::class, 'get_item_types'])->name('raw-materials.get-item-types');
  Route::post('/raw-materials/store-request', [RawMaterialController::class, 'store_request'])->name('raw-materials.store-request');
  Route::get('/raw-materials/queue-list', [RawMaterialController::class, 'queue_list'])->name('raw-materials.queue-list');

  // Raw material requests
  Route::resource('raw-material-requests', RawMaterialRequestController::class);

  // final module
  Route::resource('finish-modules', FinishModuleController::class);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');