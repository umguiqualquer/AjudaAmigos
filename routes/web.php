<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;


Route:: get('/', [LoginController::class, 'index'])->name('login.login');
Route:: post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route:: get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
Route:: post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');
Route:: get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');




// Route::group(['middleware' => 'auth'], function(){
    Route:: get('/index-user', [userController::class, 'index'])->name('user.index')->middleware('permission:index-user');


        Route:: get('/painel', [userController::class, 'painel'])->name('dashboard.index');


    Route:: get('/create-user', [userController::class, 'create'])->name('user.create')->middleware('permission:create-user');
    Route:: post('/store-user', [userController::class, 'store'])->name('user.store')->middleware('permission:store-user');
    Route:: get('/show-user/{user}', [userController::class, 'show'])->name('user.show')->middleware('permission:show-user');

    Route:: get('/edit-user/{user}', [userController::class, 'edit'])->name('user.edit')->middleware('permission:edit-user');
    Route:: put('/update-user/{user}',[userController::class, 'update'])->name('user.update')->middleware('permission:update-user');

    Route:: delete('/destroy-user/{user}', [userController::class, 'destroy'])->name('user.destroy')->middleware('permission:destroy-user');

    Route:: get('/table-user', [RegisterController::class, 'create'])->name('register.index')->middleware('permission:table-user');

    Route:: get('/generate-pdf-user', [userController::class, 'generatePdf'])->name('user.generate-pdf')->middleware('permission:generate-user');



    Route:: get('/index-role', [RoleController::class, 'index'])->name('role.index')->middleware('permission:index-role');
    Route:: get('/create-role', [RoleController::class, 'create'])->name('role.create')->middleware('permission:create-role');
    Route:: post('/store-role', [RoleController::class, 'store'])->name('role.store')->middleware('permission:store-role');
    Route:: get('/edit-role/{role}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:edit-role');
    Route:: put('/update-role/{role}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:update-role');
    Route:: delete('/destroy-role/{role}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:destroy-role');


    
    
    Route:: get('/index-role-permission/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index')->middleware('permission:index-role-permission');
    Route:: get('/update-role-permission/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update')->middleware('permission:update-role-permission');

    

// });