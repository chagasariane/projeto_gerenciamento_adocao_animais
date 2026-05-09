<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\AdocaoController;

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::resource('users', UserController::class)->only([
    'create',
    'store'
]);

Route::middleware(['auth', 'role:ADMIN'])->group(function () {
    Route::resource('users', UserController::class)->except([
        'create',
        'store'
    ]);

    Route::resource('especies', EspecieController::class);
    Route::resource('racas', RacaController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN + PROTETOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:ADMIN,PROTETOR'])->group(function () {
    Route::resource('animais', AnimalController::class);
});

/*
|--------------------------------------------------------------------------
| TODOS AUTENTICADOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:ADMIN,PROTETOR,ADOTANTE'])->group(function () {
    Route::resource('adocoes', AdocaoController::class);
});