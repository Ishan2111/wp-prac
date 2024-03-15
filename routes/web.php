<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('category/create', [CategoryController::class,'create'])->name('categories.create');

Route::get('category/view', [CategoryController::class,'index'])->name('categories.view');

Route::post('/category/store', [CategoryController::class, 'store'])->name('categories.store');

Route::put('categories/{category}/toggle', [CategoryController::class, 'toggleActive'])->name('categories.toggle');