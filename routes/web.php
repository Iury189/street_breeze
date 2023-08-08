<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FighterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\GithubSocialiteController;
use App\Http\Controllers\ChangePasswordController;

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
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/change_password', function(){
        return view('change_password');
    })->name('change_password');

    Route::get('/change_email', function(){
        return view('change_email');
    })->name('change_email');

    Route::get('/delete_user', function(){
        return view('delete_user');
    })->name('delete_user');

});

Route::controller(GoogleSocialiteController::class)->group(function() {
    // Login
    Route::get('auth/google/redirect', 'redirectGoogleLogin')->name('google.login');
    Route::get('auth/google/callback', 'callbackGoogleLogin');
    // Register
    //Route::get('auth/google/register', 'redirectGoogleRegister')->name('google.register');
    //Route::get('auth/google/callback/register', 'callbackGoogleRegister')->name('google.register.callback');
});

Route::controller(GithubSocialiteController::class)->group(function() {
    Route::get('auth/github/redirect', 'redirectGithubLogin')->name('github.login');
    Route::get('auth/github/callback', 'callbackGithubLogin');
});

Route::middleware(['auth'])->group(function() {
    Route::controller(UserController::class)->group(function(){
        Route::get('/user', 'index')->name('index');
        Route::get('/trash-user', 'trashUser')->name('trashHunter');

        Route::middleware('role:Admin')->group(function () {
            Route::get('/create-user', 'formCreateUser')->name('formCreateUser');
            Route::post('/store-user', 'storeUser')->name('storeUser');
            Route::get('/edit-user/{id}', 'editUser')->name('editUser');
            Route::patch('/update-user/{id}', 'updateUser')->name('updateUser');
            Route::delete('/destroy-user/{id}', 'destroyUser')->name('destroyUser');
            Route::delete('/delete-user-trash/{id}', 'deleteUserTrash')->name('deleteUserTrash');
            Route::get('/restore-user-trash/{id}', 'restoreUserTrash')->name('restoreUserTrash');
        });
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(RoleController::class)->group(function(){
        Route::get('/role', 'index')->name('index');
        Route::get('/trash-role', 'trashRole')->name('trashRole');

        Route::middleware('role:Admin')->group(function () {
            Route::get('/add-role', 'formCreateRole')->name('formCreateRole');
            Route::post('/add-role', 'storeRole')->name('storeRole');
            Route::get('/update-role/{id}', 'editRole')->name('editRole');
            Route::patch('/update-role/{id}', 'updateRole')->name('updateRole');
            Route::delete('/delete-role/{id}', 'destroyRole')->name('destroyRole');
            Route::delete('/delete-role-trash/{id}', 'deleteRoleTrash')->name('deleteRoleTrash');
            Route::get('/restore-role-trash/{id}', 'restoreRoleTrash')->name('restoreRoleTrash');
        });
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(PermissionController::class)->group(function(){
        Route::get('/permission', 'index')->name('index');
        Route::get('/trash-permission', 'trashPermission')->name('trashPermission');

        Route::middleware('role:Admin')->group(function () {
            Route::get('/add-permission', 'formCreatePermission')->name('formCreatePermission');
            Route::post('/add-permission', 'storePermission')->name('storePermission');
            Route::get('/update-permission/{id}', 'editPermission')->name('editPermission');
            Route::patch('/update-permission/{id}', 'updatePermission')->name('updatePermission');
            Route::delete('/delete-permission/{id}', 'destroyPermission')->name('destroyPermission');
            Route::delete('/delete-permission-trash/{id}', 'deletePermissionTrash')->name('deletePermissionTrash');
            Route::get('/restore-permission-trash/{id}', 'restorePermissionTrash')->name('restorePermissionTrash');
        });
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(ChangePasswordController::class)->group(function(){
        Route::post('/update-password', 'updatePassword')->name('updatePassword');
        Route::post('/update-email', 'updateEmail')->name('updateEmail');
        Route::post('/delete-user', 'deleteUser')->name('deleteUser');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(FighterController::class)->group(function(){
        Route::get('/fighter', 'index')->name('index');
        Route::get('/add-fighter', 'create')->name('create');
        Route::get('/search-fighter', 'searchFighter');
        Route::post('/add-fighter', 'store')->name('store');
        Route::get('/update-fighter/{id}', 'edit')->name('edit');
        Route::patch('/update-fighter/{id}', 'update')->name('update');
        Route::delete('/delete-fighter/{id}', 'destroy')->name('destroy');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(MasterController::class)->group(function(){
        Route::get('/master', 'index')->name('index');
        Route::get('/add-master', 'create')->name('create');
        Route::post('/add-master', 'store')->name('store');
        Route::get('/update-master/{id}', 'edit')->name('edit');
        Route::patch('/update-master/{id}', 'update')->name('update');
        Route::delete('/delete-master/{id}', 'destroy')->name('destroy');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(DojoController::class)->group(function(){
        Route::get('/dojo', 'index')->name('index');
        Route::get('/add-dojo', 'create')->name('create');
        Route::post('/add-dojo', 'store')->name('store');
        Route::get('/update-dojo/{id}', 'edit')->name('edit');
        Route::patch('/update-dojo/{id}', 'update')->name('update');
        Route::delete('/delete-dojo/{id}', 'destroy')->name('destroy');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(FightController::class)->group(function(){
        Route::get('/fight', 'index')->name('index');
        Route::get('/add-fight', 'create')->name('create');
        Route::get('/pdf-fight/{id}', 'fightPDF')->name('fightPDF');
        Route::get('/excel-fight/{id}', 'fightExcel')->name('fightExcel');
        Route::post('/add-fight', 'store')->name('store');
        Route::delete('/delete-fight/{id}', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';
