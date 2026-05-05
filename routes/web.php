<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return redirect('/todos');
});

Route::get('/todos', [TodoController::class, 'index']);