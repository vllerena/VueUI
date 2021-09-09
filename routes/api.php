<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminCheck;

Route::middleware(['auth:sanctum', AdminCheck::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('app/get_tag', [AdminController::class, 'listTag']);
    Route::post('app/create_tag', [AdminController::class, 'addTag']);
    Route::post('app/edit_tag', [AdminController::class, 'editTag']);
    Route::post('app/delete_tag', [AdminController::class, 'deleteTag']);

    Route::get('app/get_user', [AdminController::class, 'listUser']);
    Route::post('app/create_user', [AdminController::class, 'addUser']);
    Route::post('app/edit_user', [AdminController::class, 'editUser']);
    Route::post('app/delete_user', [AdminController::class, 'deleteUser']);

    Route::get('app/get_role', [AdminController::class, 'listRole']);
    Route::post('app/create_role', [AdminController::class, 'addRole']);
    Route::post('app/edit_role', [AdminController::class, 'editRole']);
    Route::post('app/assign_roles', [AdminController::class, 'assignRole']);

});

//Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
