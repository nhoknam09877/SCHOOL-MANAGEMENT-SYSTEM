<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect('/login');
});
require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');

