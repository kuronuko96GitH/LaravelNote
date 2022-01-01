<?php

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

// Route::get('/', function () {
//     // Topページ
//     return view('welcome');
// });
//
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/phpinfo', [App\Http\Controllers\HomeController::class, 'info'])->name('phpinfo');
Route::get('/sqltest', [App\Http\Controllers\HomeController::class, 'sqltest'])->name('sqltest');
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // ログイン(認証)をしないと、直接URLを指定しても接続できません。
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
});
