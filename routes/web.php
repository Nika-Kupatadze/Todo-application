<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksDeleteController;

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

Route::get('/', "App\Http\Controllers\TasksController@index");

Route::resource('tasks', TasksController::class)->only([
    'index',
    'store',
    'edit'
]);

Route::delete('/deleteAll', [TasksDeleteController::class, 'deleteAll'])->name('deleteAll');


