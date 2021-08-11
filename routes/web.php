<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/books', [BookController::class, 'store'])->middleware(['auth', 'validated']);

Route::get('/books/create', [BookController::class, 'create'])
->middleware("can:create, \App\Models\Book");

Route::get('/demo', function (){
    return App\Facades\Char::getCamelCaseFromSnakeCase('call_of_duty');
});
