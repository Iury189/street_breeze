<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FighterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ClasseController;

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

Route::controller(ClasseController::class)->group(function() {
    Route::get('/classe', 'index');
    Route::get('/add-classe', 'create');
    Route::post('/add-classe', 'store');
    Route::get('/update-classe/{id}', 'edit');
    Route::patch('/update-classe/{id}', 'update');
    Route::delete('/delete-classe/{id}', 'destroy');
});

// Route::prefix('fighter')->group(function() {
//     Route::get('/create', [FighterController::class, 'create'])->name('fighter.create');
// });

require __DIR__.'/auth.php';