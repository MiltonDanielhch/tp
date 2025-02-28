<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\organizationsController;
use App\Http\Controllers\OrganizationRouteController;
use App\Http\Controllers\AssociateController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::post('search', [HomeController::class, 'search'])->name('search');   

Route::get('maintenance', function () {
    return view('errors.maintenance');
})->name('errors.maintenance');

// Route::get('/associates/{associate}',[AssociateController::class, 'showDetails'] )->name('associates.showDetails');

Route::controller(AssociateController::class)->group(function(){
    Route::get('asociados/{id}','showDetails')->name('associates.showDetails');
});
Route::group(['prefix' => 'admin', 'middleware' => 'desarrollo.creativo'], function () {
    Voyager::routes();

    Route::controller(organizationsController::class)->group(function(){
        Route::get('organizations/{organization}/toggle','toggleActive')->name('organizations.toggleActive');
    });
    Route::controller(OrganizationRouteController::class)->group(function(){
        Route::get('organizacion/{organizacion}/rutas','edit')->name('organizacion.rutas.edit')->middleware('auth');
        Route::put('organizacion/{organizacion}/rutas','update')->name('organizacion.rutas.update')->middleware('auth');
        Route::delete('organizacion/{organizacion}/rutas/{ruta}','destroy')->name('organizacion.rutas.destroy')->middleware('auth');

        // para decargar o ver el archivo
        Route::get('organizacion/{organizacion}/rutas/{ruta}/download','download')->name('organizacion.rutas.download')->middleware('auth');        
    });
    Route::controller(AssociateController::class)->group(function(){
        Route::get('Asociados/{id}/qr','showQrCode')->name('associates.showQrCode')->middleware('auth');    
    });
});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
    