<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index']);
Route::any('/{vue_capture?}', [AdminController::class, 'index'])->where('vue_capture', '[\/\w\.-]*');
