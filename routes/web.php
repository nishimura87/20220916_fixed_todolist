<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::post('/add', [TodoController::class, 'add']);
Route::post('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::post('/delete/{id}', [TodoController::class, 'delete'])->name('todo.delete');