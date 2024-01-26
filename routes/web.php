<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LeadsourceController;
use App\Http\Controllers\Admin\LeadStatusController;
use App\Http\Controllers\Admin\LeadsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('front.index');
});
Route::get('/plans', function () {
    return view('front.plans');
})->name('plans');
Route::get('/contact-us', function () {
    return view('front.contact');
})->name('contactus');

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);

Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::get('/create/{id?}', [PermissionController::class, 'create'])->name('create');
    Route::post('/store', [PermissionController::class, 'store'])->name('store');
    Route::get('/delete', [PermissionController::class, 'delete'])->name('delete');
   
});


Route::group(['prefix' => 'leadstatus', 'as' => 'leadstatus.'], function () {
    Route::get('/', [LeadStatusController::class, 'index'])->name('index');
    Route::get('/manage/{id?}', [LeadStatusController::class, 'manage'])->name('manage');
    Route::post('/store', [LeadStatusController::class, 'store'])->name('store');
    Route::get('/delete', [LeadStatusController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'leadresources', 'as' => 'leadresources.'], function () {
    Route::get('/', [LeadsourceController::class, 'index'])->name('index');
    Route::get('/manage/{id?}', [LeadsourceController::class, 'manage'])->name('manage');
    Route::post('/store', [LeadsourceController::class, 'store'])->name('store');
    Route::get('/delete', [LeadsourceController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'leads', 'as' => 'leads.'], function () {
    Route::get('/{type?}', [LeadsController::class, 'index'])->name('index');
    Route::get('/manage/{id?}', [LeadsController::class, 'create'])->name('manage');
    Route::post('/store', [LeadsController::class, 'store'])->name('store');
    Route::get('/delete', [LeadsController::class, 'delete'])->name('delete');
    Route::get('/delete', [LeadsController::class, 'delete'])->name('delete');
    Route::post('/processImport', [LeadsController::class, 'processImport'])->name('processImport');
});


