<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
})->name('welcome');

Route::get('/redirect-to-welcome', function() {
    Cookie::queue(Cookie::forget(Str::slug(env('APP_NAME'), '_').'_session'));
    if(Cookie::has('remember_me_'.Str::slug(env('APP_NAME')))){
        Cookie::queue(Cookie::forget('remember_me_'.Str::slug(env('APP_NAME'))));
    }
    return redirect(route('welcome'));
})->name('redirectToWelcome');

Auth::routes(['verify' => true]);

Route::post('/user-login', [App\Http\Controllers\Auth\LoginController::class, 'userLogin'])->name('userLogin');
Route::post('/user-register', [App\Http\Controllers\Auth\RegisterController::class, 'userRegister'])->name('userRegister');

Route::middleware(['auth','verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('adminHome');

        Route::get('/add-a-supervisor', [App\Http\Controllers\AdminController::class, 'addASupervisor'])->name('addASupervisor');
        Route::post('/create-a-supervisor', [App\Http\Controllers\AdminController::class, 'createASupervisor'])->name('createASupervisor');
        Route::get('/manage-supervisors', [App\Http\Controllers\AdminController::class, 'manageSupervisors'])->name('manageSupervisors');

        Route::get('/admin-manage-todos', [App\Http\Controllers\AdminController::class, 'adminManageTodos'])->name('adminManageTodos');
    });

    Route::middleware(['supervisor'])->group(function () {
        Route::get('/revoked-supervisor-home', [App\Http\Controllers\HomeController::class, 'revokedSupervisorHome'])->name('revokedSupervisorHome')->middleware('revoked');

        Route::middleware(['notRevoked'])->group(function () {
            Route::get('/supervisor-home', [App\Http\Controllers\HomeController::class, 'supervisorHome'])->name('supervisorHome');

            Route::get('/add-a-todo', [App\Http\Controllers\SupervisorController::class, 'addATodo'])->name('addATodo');
            Route::post('/create-a-todo', [App\Http\Controllers\SupervisorController::class, 'createATodo'])->name('createATodo');
            Route::get('/manage-todos', [App\Http\Controllers\SupervisorController::class, 'manageTodos'])->name('manageTodos');
        });
    });

    Route::middleware(['stuff'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

        Route::get('/assigned-todos', [App\Http\Controllers\StuffController::class, 'assignedTodos'])->name('assignedTodos');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('customLogout');
});
