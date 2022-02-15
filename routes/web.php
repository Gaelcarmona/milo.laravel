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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('accueil');
});

Auth::routes();

//affichage admin
Route::get('/admin', function () {
    return view('admin');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/login',[App\Http\Controllers\UserController::class, 'insert'])->name('insert.user');

Route::get('/login', function () {
    return view('login');
});
//Route::post('login',[App\Http\Controllers\UserController::class, 'login'])->name('login.user');

//formulaire d'édition d'un user
Route::get('/user/edit/{id}', function($id) {
    return view('useredit',['user' => App\Models\User::where('id',$id)->first()]);
})->name('user.edit');

////update d'un user'
Route::post('/user/update/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('user.update');
//
////suppression d'un user'
Route::get('/user/delete/{id}',[App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
