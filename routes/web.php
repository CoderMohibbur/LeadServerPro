<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SheetListController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('User', UserController::class);


    Route::resource('roles', RoleController::class);
});

// routes/web.php
Route::get('/sheet-list', [SheetListController::class, 'index']);
Route::get('/sheet-list/create', [SheetListController::class, 'create']);
Route::post('/sheet-list', [SheetListController::class, 'store']);
Route::resource('sheet-lists', SheetListController::class);
