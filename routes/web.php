<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', 'doLogout')->middleware([OnlyMemberMiddleware::class]);
});

Route::controller(TodolistController::class)->middleware([OnlyMemberMiddleware::class])->group(function () {
    Route::get('/todolist', 'todolist');
    Route::post('/todolist', 'addTodo');
    Route::post('/todolist/{id}/delete', 'deleteTodo');
});
