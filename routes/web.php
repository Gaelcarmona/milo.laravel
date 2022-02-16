<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ChampionshipController;
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
    return view('accueil');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Route::get('/admin', function () {
//    return view('admin');
//});
//
//vers le profil utilisateur
Route::get('/user', function () {
    return view('user');
});

//vers le formulaire de création de joueurs par un user
Route::get('/createplayer', function () {
    return view('createplayer');
})->name('createplayer');

//création de joueurs par un user
Route::post('/player/insert', [UserController::class, 'playerInsert'])->name('insert.player');

//vers le formulaire de création de championnat par un user
//Route::get('/createchampionship', function () {
//    return view('createchampionship');
//})->name('create.championship');

Route::get('/createchampionship',[ChampionshipController::class, 'championshipForm'])->name('create.championship');

//création de championnat par un user
Route::post('/championship/insert', [ChampionshipController::class, 'insert'])->name('insert.championship');

require __DIR__ . '/auth.php';
