<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');  //cambiar
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::resource('personas', 'App\Http\Controllers\UserController')->middleware('auth');
Route::get('/ejecutivos', 'App\Http\Controllers\UserController@ejecutivos')->name('ejecutivos.index')->middleware('auth');
Route::get('/administradores', 'App\Http\Controllers\UserController@administradores')->name('administradores.index')->middleware('auth');

Route::resource('visitas', 'App\Http\Controllers\VisitaController')->middleware('auth');
Route::get('/visitas/create', [App\Http\Controllers\VisitaController::class, 'create'])->name('visita.create');
Route::get('visitas/{visita}', [App\Http\Controllers\VisitaController::class, 'show'])->name('visita.show');


Route::get('user/pdf/{tipo}', 'App\Http\Controllers\UserController@generarPdf')->name('user.pdf');
Route::get('user/csv/{tipo}', 'App\Http\Controllers\UserController@generarCsv')->name('user.csv');
Route::get('visita/pdf/{tipo}', 'App\Http\Controllers\VisitaController@generarPdf')->name('visita.pdf');
Route::get('visita/csv/{tipo}', 'App\Http\Controllers\VisitaController@generarCsv')->name('visita.csv');


