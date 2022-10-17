<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FighterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DojoController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(FighterController::class)->group(function() {
    Route::get('/fighter', 'index');
    Route::get('/add-fighter', 'create');
    Route::post('/add-fighter', 'store');
    Route::get('/update-fighter/{id}', 'edit');
    Route::patch('/update-fighter/{id}', 'update');
    Route::delete('/delete-fighter/{id}', 'destroy');
});

Route::controller(MasterController::class)->group(function() {
    Route::get('/master', 'index');
    Route::get('/add-master', 'create');
    Route::post('/add-master', 'store');
    Route::get('/update-master/{id}', 'edit');
    Route::patch('/update-master/{id}', 'update');
    Route::delete('/delete-master/{id}', 'destroy');
});

Route::controller(DojoController::class)->group(function() {
    Route::get('/dojo', 'index');
    Route::get('/add-dojo', 'create');
    Route::post('/add-dojo', 'store');
    Route::get('/update-dojo/{id}', 'edit');
    Route::patch('/update-dojo/{id}', 'update');
    Route::delete('/delete-dojo/{id}', 'destroy');
});

require __DIR__.'/auth.php';