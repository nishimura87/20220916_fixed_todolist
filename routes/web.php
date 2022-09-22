<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/home', [TodoController::class, 'index']);
Route::post('/add', [TodoController::class, 'add']);
Route::post('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::post('/delete/{id}', [TodoController::class, 'delete'])->name('todo.delete');
Route::post('/logout', [TodoController::class, 'logout']);
Route::get('/find', [TodoController::class, 'find'])->name('todo.find');
Route::post('/search', [TodoController::class, 'search']);
Route::post('/return', [TodoController::class, 'return']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';