<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\organizationsController;
use App\Http\Controllers\OrganizationRouteController;

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});

Route::get('maintenance', function () {
    return view('errors.maintenance');
})->name('errors.maintenance');

Route::group(['prefix' => 'admin', 'middleware' => 'desarrollo.creativo'], function () {
    Voyager::routes();

    Route::controller(organizationsController::class)->group(function(){
        Route::get('organizations/{organization}/toggle','toggleActive')->name('organizations.toggleActive');
    });
    Route::controller(OrganizationRouteController::class)->group(function(){
        Route::get('organizacion/{organizacion}/rutas','edit')->name('organizacion.rutas.edit');
        Route::post('organizations/{organization}/routes','update')->name('organizations.routes.update');
    });
});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
    