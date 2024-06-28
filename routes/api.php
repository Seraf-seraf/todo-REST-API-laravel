<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TasksController;
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

Route::controller(TasksController::class)->group(function () {
    Route::get('/tasks', 'index')->name('tasks.index');
    Route::post('/tasks', 'store')->name('tasks.store');
    Route::get('/tasks/{id}', 'show')->name('tasks.show');
    Route::patch('/tasks/{id}', 'update')->name('tasks.update');
    Route::delete('/tasks/{id}', 'destroy')->name('tasks.destroy');
});
