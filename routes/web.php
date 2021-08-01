<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/create', [BookController::class, 'create'])->name('create');
Route::post('/save', [BookController::class, 'save'])->name('save');

Route::get('/edit/{id}',[BookController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [BookController::class, 'update'])->name('update');
Route::delete('/delete/{id}',[BookController::class, 'delete'])->name('delete');
Route::any('/search',[BookController::class, 'search'])->name('search');
Route::any('/sort',[BookController::class, 'sort'])->name('sort');
