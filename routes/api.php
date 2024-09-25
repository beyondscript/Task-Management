<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/all-supervisors', [App\Http\Controllers\AdminController::class, 'allSupervisors']);
        Route::patch('/revoke-supervisor', [App\Http\Controllers\AdminController::class, 'revokeSupervisor']);
        Route::patch('/approve-supervisor', [App\Http\Controllers\AdminController::class, 'approveSupervisor']);

        Route::get('/all-todos', [App\Http\Controllers\AdminController::class, 'allTodos']);
        Route::get('/get-todo-reports', [App\Http\Controllers\AdminController::class, 'getTodoReports']);
    });

    Route::middleware(['supervisor'])->group(function () {
        Route::get('/assignor-todos', [App\Http\Controllers\SupervisorController::class, 'assignorTodos']);
        Route::patch('/mark-todo-as-completed', [App\Http\Controllers\SupervisorController::class, 'markTodoAsCompleted']);
        Route::delete('/destroy-todo', [App\Http\Controllers\SupervisorController::class, 'destroyTodo']);
        Route::get('/get-assignor-todo-reports', [App\Http\Controllers\SupervisorController::class, 'getAssignorTodoReports']);
    });

    Route::middleware(['stuff'])->group(function () {
        Route::get('/get-assignee-todo-reports', [App\Http\Controllers\StuffController::class, 'getAssigneeTodoReports']);
        Route::get('/assignee-todos', [App\Http\Controllers\StuffController::class, 'assigneeTodos']);
    });
});

Route::get('/refresh-csrf-token', [App\Http\Controllers\CsrfCookieController::class, 'refreshCsrfCookie']);
