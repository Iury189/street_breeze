<?php

namespace App\Http\Controller\FighController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FighterController;

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
    Route::get('/index', 'index');
    Route::get('/add-fighter', 'create');
    Route::post('/add-fighter', 'store');
    Route::get('/update-fighter/{id}', 'edit');
    Route::patch('/update-fighter/{id}', 'update');
    Route::delete('/delete-fighter/{id}', 'destroy');
});

// Route::prefix('fighter')->group(function() {
//     Route::get('/create', [FighterController::class, 'create'])->name('fighter.create');
// });

require __DIR__.'/auth.php';