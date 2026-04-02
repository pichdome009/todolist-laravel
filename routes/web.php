<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store'])->name('todo.store');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');

Route::patch('/todos/{id}/complete', [TodoController::class, 'toggleComplete'])->name('todo.complete');
Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todo.update');