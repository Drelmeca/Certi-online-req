<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::group(['auth', 'verified'], function(){
    
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

    Route::get('users',[\App\Http\Controllers\UserController::class,'index'])->name('users');

    Route::get('/users/create',[\App\Http\Controllers\UserController::class,'create'])->name('users.create');
    Route::get('/users/edit/{id}',[\App\Http\Controllers\UserController::class,'edit'])->name('users.edit');
    Route::post('/users/store',[\App\Http\Controllers\UserController::class,'store'])->name('users.store');
    
    Route::get('/CertRequest',[\App\Http\Controllers\CertRequestController::class,'index'])->name('certrequest');
    Route::get('/CertRequest/create',[\App\Http\Controllers\CertRequestController::class,'create'])->name('certrequest.create'); 
    Route::get('/CertRequest/edit/{id}',[\App\Http\Controllers\CertRequestController::class,'edit'])->name('certrequest.edit');
    Route::post('/CertRequest/store',[\App\Http\Controllers\CertRequestController::class,'store'])->name('certrequest.store');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
