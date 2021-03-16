<?php

use Illuminate\Support\Facades\Route;


if(config('crud.mode') == 'mpa'){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class,'index'])->name('home');

    Route::get('/myprofile', [App\Http\Controllers\Admin\ProfileController::class, 'showProfilePage'])->name('profile');
    Route::put('/myprofile', [App\Http\Controllers\Admin\ProfileController::class,'updateProfile']);
    Route::get('/password', [App\Http\Controllers\Admin\ProfileController::class, 'showPasswordPage'])->name('password');
    Route::put('/password', [App\Http\Controllers\Admin\ProfileController::class, 'changePassword']);


    Route::post('usermanagement/bulkdelete', [App\Http\Controllers\Admin\UserManagementController::class, 'bulkDelete'])->name('usermanagement.bulkdelete');
    Route::post('usermanagement/api', [App\Http\Controllers\Admin\UserManagementController::class,'api'])->name('usermanagement.api');
    Route::resource('usermanagement', App\Http\Controllers\Admin\UserManagementController::class);

}else{
    Route::get('/', App\Http\Controllers\Admin\AdminController::class, 'spa');
}

if(config('crud.use_login') == true){
    Route::get('/login', [App\Http\Controllers\Auth\AuthController::class,'showLoginForm'])->name('login');
    Route::get('/post', [App\Http\Controllers\Auth\AuthController::class,'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class,'logout'])->name('logout');
}
