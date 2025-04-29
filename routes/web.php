<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;


Route:: get('/', [LoginController::class, 'index'])->name('login.login');
Route:: post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route:: get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
Route:: post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');
Route:: get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');




Route::group(['middleware' => 'auth'], function(){
    Route:: get('/index-user', [userController::class, 'index'])->name('user.index');
    Route:: get('/create-user', [userController::class, 'create'])->name('user.create');
    Route:: post('/store-user', [userController::class, 'store'])->name('user.store');
    Route:: get('/show-user/{user}', [userController::class, 'show'])->name('user.show');

    Route:: get('/edit-user/{user}', [userController::class, 'edit'])->name('user.edit');
    Route:: put('/update-user/{user}',[userController::class, 'update'])->name('user.update');

    Route:: delete('/destroy-user/{user}', [userController::class, 'destroy'])->name('user.destroy');

    Route::get('/table-user', [RegisterController::class, 'create'])->name('register.index');

});