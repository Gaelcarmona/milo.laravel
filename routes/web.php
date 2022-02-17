<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\DeckController;
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





//Gestion des joueurs
//vers le formulaire de création de joueurs par un user
Route::get('/createplayer', function () {
    return view('createplayer');
})->name('createplayer');

//création de joueurs par un user
Route::post('/player/insert', [UserController::class, 'playerInsert'])->name('insert.player');

//Affichage des joueurs
Route::get('/players',[UserController::class, 'displayPlayers'])->name('players');

//Formulaire d'édition d'un joueur
Route::get('/player/edit/{id}',[UserController::class, 'editPlayerForm'])->name('editPlayer');

//Update d'un joueur
Route::post('/player/update',[App\Http\Controllers\UserController::class, 'playerUpdate'])->name('update.player');

//Delete d'un joueur
Route::get('/player/delete/{id}',[UserController::class, 'delete'])->name('player.delete');

//Profil d'un joueur
Route::get('/player/{id}',[UserController::class, 'displayPlayerProfile'])->name('displayPlayerProfile');





//gestion des championnats
//vers le formulaire de création de championnat par un user
Route::get('/createchampionship',[ChampionshipController::class, 'championshipForm'])->name('create.championship');

//création de championnat par un user
Route::post('/championship/insert', [ChampionshipController::class, 'insert'])->name('insert.championship');

//Affichage des championnats
Route::get('/championships',[ChampionshipController::class, 'displayChampionships'])->name('championships');

//Formulaire d'édition d'un championnat
Route::get('/championship/edit/{id}',[ChampionshipController::class, 'editChampionshipForm'])->name('editChampionship');

//Update d'un championnat
Route::post('/championship/update',[ChampionshipController::class, 'championshipUpdate'])->name('update.championship');

//Delete d'un championnat
Route::get('/championship/delete/{id}',[ChampionshipController::class, 'delete'])->name('championship.delete');





//gestion des decks
//vers le formulaire de création de deck par un user
Route::get('/createDeck/{id}',[DeckController::class, 'deckForm'])->name('form.deck');

//création de deck par un user
Route::post('/deck/insert', [DeckController::class, 'insert'])->name('insert.deck');

//Affichage des decks
Route::get('/decks',[DeckController::class, 'displayDecks'])->name('decks');

//Formulaire d'édition d'un deck
Route::get('/deck/edit/{id}',[DeckController::class, 'editDeckForm'])->name('editForm.deck');

//Update d'un deck
Route::post('/deck/update',[DeckController::class, 'deckUpdate'])->name('update.deck');

//Delete d'un deck
Route::get('/deck/delete/{id}',[DeckController::class, 'delete'])->name('delete.deck');














require __DIR__ . '/auth.php';
