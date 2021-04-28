<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/user/{user}', [App\Http\Controllers\TasksController::class, 'index'])->name('task.index')->middleware('task');
Route::post('/p', [App\Http\Controllers\TasksController::class, 'store'])->name('task.store');
Route::get('/p/{task}/edit', [App\Http\Controllers\TasksController::class, 'edit'])->name('task.edit');
Route::patch('/p/{task}', [App\Http\Controllers\TasksController::class, 'update'])->name('task.update');
Route::patch('/p/{task}/completed', [App\Http\Controllers\TasksController::class, 'completed']);
Route::delete('/p/{task}', [App\Http\Controllers\TasksController::class, 'destroy'])->name('task.destroy');


