<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdocaoController;
use App\Http\Controllers\AnimalFotoController;

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| PÁGINAS INSTITUCIONAIS
|--------------------------------------------------------------------------
*/

Route::view('/como-funciona','pages.como-funciona')->name('como-funciona');

Route::view('/sobre','pages.sobre')->name('sobre');

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])
    ->name('register');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| CADASTRO PÚBLICO
|--------------------------------------------------------------------------
*/

Route::resource('users', UserController::class)->only([
    'create',
    'store'
]);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class)->except([
        'create',
        'store'
    ]);

    Route::resource('especies', EspecieController::class);

    Route::resource('racas', RacaController::class);

});

/*
|--------------------------------------------------------------------------
| USUÁRIOS AUTENTICADOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | PERFIL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/perfil',
        [UserController::class, 'perfil']
    )->name('perfil');

    /*
    |--------------------------------------------------------------------------
    | EDITAR PERFIL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/perfil/editar',
        [UserController::class, 'editarPerfil']
    )->name('perfil.editar');

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR PERFIL
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/perfil',
        [UserController::class, 'atualizarPerfil']
    )->name('perfil.update');

    /*
    |--------------------------------------------------------------------------
    | ANIMAIS
    |--------------------------------------------------------------------------
    */
    Route::get('/especies/{id}/racas',[AnimalController::class, 'racasPorEspecie'])->name('especies.racas');
    Route::resource('animais', AnimalController::class);

    /*
    |--------------------------------------------------------------------------
    | FOTOS DOS ANIMAIS
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/animais/{animal}/fotos',
        [AnimalFotoController::class, 'store']
    )->name('animais.fotos.store');

    Route::delete(
        '/animais/fotos/{foto}',
        [AnimalFotoController::class, 'destroy']
    )->name('animais.fotos.destroy');

    Route::patch(
        '/animais/{animal}/fotos/reordenar',
        [AnimalFotoController::class, 'reordenar']
    )->name('animais.fotos.reordenar');

    /*
    |--------------------------------------------------------------------------
    | ADOÇÕES
    |--------------------------------------------------------------------------
    */

    Route::resource('adocoes', AdocaoController::class);

});