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

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Route::get('verify-email', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('verify-email/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('resend-verify-email', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/redirect-to-welcome', function() {
    Cookie::queue(Cookie::forget(Str::slug(env('APP_NAME'), '_').'_session'));
    if(Cookie::has('remember_me_'.Str::slug(env('APP_NAME')))){
        Cookie::queue(Cookie::forget('remember_me_'.Str::slug(env('APP_NAME'))));
    }
    return redirect(route('welcome'));
})->name('redirectToWelcome');

Route::get('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password-with-token', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('confirm-password', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('confirm-password', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

Auth::routes(['verify' => false, 'reset' => false, 'confirm' => false, 'logout' => false]);

Route::middleware(['auth','verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('adminHome');

        Route::get('/admin/change-email', [App\Http\Controllers\SettingsController::class, 'adminChangeEmail'])->name('adminChangeEmail');
        Route::patch('/admin/update-email', [App\Http\Controllers\SettingsController::class, 'adminUpdateEmail'])->name('adminUpdateEmail');

        Route::get('/admin/change-password', [App\Http\Controllers\SettingsController::class, 'adminChangePassword'])->name('adminChangePassword');
        Route::patch('/admin/update-password', [App\Http\Controllers\SettingsController::class, 'adminUpdatePassword'])->name('adminUpdatePassword');

        Route::get('/admin/add-a-supervisor', [App\Http\Controllers\AdminController::class, 'addASupervisor'])->name('addASupervisor');
        Route::post('/admin/create-a-supervisor', [App\Http\Controllers\AdminController::class, 'createASupervisor'])->name('createASupervisor');
        Route::get('/admin/manage-supervisors', [App\Http\Controllers\AdminController::class, 'manageSupervisors'])->name('manageSupervisors');

        Route::get('/admin/manage-tasks', [App\Http\Controllers\AdminController::class, 'adminManageTodos'])->name('adminManageTodos');
    });

    Route::middleware(['supervisor'])->group(function () {
        Route::get('/supervisor/revoked-home', [App\Http\Controllers\HomeController::class, 'revokedSupervisorHome'])->name('revokedSupervisorHome')->middleware('revoked');

        Route::middleware(['notRevoked'])->group(function () {
            Route::get('/supervisor/home', [App\Http\Controllers\HomeController::class, 'supervisorHome'])->name('supervisorHome');

            Route::get('/supervisor/change-email', [App\Http\Controllers\SettingsController::class, 'supervisorChangeEmail'])->name('supervisorChangeEmail');
            Route::patch('/supervisor/update-email', [App\Http\Controllers\SettingsController::class, 'supervisorUpdateEmail'])->name('supervisorUpdateEmail');

            Route::get('/supervisor/change-password', [App\Http\Controllers\SettingsController::class, 'supervisorChangePassword'])->name('supervisorChangePassword');
            Route::patch('/supervisor/update-password', [App\Http\Controllers\SettingsController::class, 'supervisorUpdatePassword'])->name('supervisorUpdatePassword');

            Route::get('/supervisor/add-a-task', [App\Http\Controllers\SupervisorController::class, 'addATodo'])->name('addATodo');
            Route::post('/supervisor/create-a-task', [App\Http\Controllers\SupervisorController::class, 'createATodo'])->name('createATodo');
            Route::get('/supervisor/manage-tasks', [App\Http\Controllers\SupervisorController::class, 'manageTodos'])->name('manageTodos');
        });
    });

    Route::middleware(['stuff'])->group(function () {
        Route::get('/stuff/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

        Route::get('/stuff/change-email', [App\Http\Controllers\SettingsController::class, 'changeEmail'])->name('changeEmail');
        Route::patch('/stuff/update-email', [App\Http\Controllers\SettingsController::class, 'updateEmail'])->name('updateEmail');

        Route::get('/stuff/change-password', [App\Http\Controllers\SettingsController::class, 'changePassword'])->name('changePassword');
        Route::patch('/stuff/update-password', [App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('updatePassword');

        Route::get('/stuff/assigned-tasks', [App\Http\Controllers\StuffController::class, 'assignedTodos'])->name('assignedTodos');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');
});

Route::get('/{any}', function () {
    return view('vuePages');
})->where('any','.*');
