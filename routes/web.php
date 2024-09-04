<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'main'])->name('main');

Route::get('/create', [UserController::class, 'create'])->name('create');

Route::post('/create_at', [UserController::class, 'save_film'])->name('save_film');

Route::post('/create_in', [UserController::class, 'save_actors'])->name('save_actors');

Route::delete('/delete', [UserController::class, 'destroy'])->name('destroy');

Route::get('/show/{id}', [UserController::class, 'show'])->name('show');

Route::put('/show/{id}/update_film', [UserController::class, 'update_film'])->name('update_film');

Route::put('/show/{id}/add_actors', [UserController::class, 'add_actors'])->name('add_actors');

Route::delete('/show/{id}/destroy_actor', [UserController::class, 'destroy_actor'])->name('destroy_actor');

Route::post('/sort', [UserController::class, 'sort'])->name('sort');