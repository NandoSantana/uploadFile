<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    return view('welcomeEmail');
});

Route::post('registrar', [EmailListController::class, 'upload']);


Route::get('/exibir', function () {
    return view('listagem');
});

// Route::get('listar', [EmailListController::class, 'show']);
Route::get('listar', [EmailListController::class, 'show']);
