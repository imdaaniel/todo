<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('task.index');
    Route::get('/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::post('/', [TaskController::class, 'store'])->name('task.store');
    Route::put('/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
});
