<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);
Route::put('tasks/{task}/changestatus', [TaskController::class, 'changeStatus'])->name('tasks.changeStatus');