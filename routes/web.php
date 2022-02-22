<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\MatchsController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\KillController;
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

//Profil d'un championnat
Route::get('/championship/{id}',[ChampionshipController::class, 'displayChampionshipProfile'])->name('displayChampionshipProfile');

//Formulaire d'édition d'un championnat
Route::get('/championship/edit/{id}',[ChampionshipController::class, 'editChampionshipForm'])->name('editChampionship');

//Update d'un championnat
Route::post('/championship/update',[ChampionshipController::class, 'championshipUpdate'])->name('update.championship');

//Delete d'un championnat
Route::get('/championship/delete/{id}',[ChampionshipController::class, 'delete'])->name('championship.delete');





//gestion des decks
//vers le formulaire de création de deck par un joueur
Route::get('/createDeck/{id}',[DeckController::class, 'deckForm'])->name('form.deck');

//création de deck par un joueur
Route::post('/deck/insert', [DeckController::class, 'insert'])->name('insert.deck');

//Profil d'un deck
Route::get('/deck/{id}',[DeckController::class, 'displayDeckProfile'])->name('displayDeckProfile');

//Formulaire d'édition d'un deck
Route::get('/deck/edit/{id}',[DeckController::class, 'editDeckForm'])->name('editForm.deck');

//Update d'un deck
Route::post('/deck/update',[DeckController::class, 'deckUpdate'])->name('update.deck');

//Delete d'un deck
Route::get('/deck/delete/{id}',[DeckController::class, 'delete'])->name('delete.deck');










//gestion des matchs
//vers le formulaire de création de match par un user
Route::get('/createMatch/{id}',[MatchsController::class, 'matchForm'])->name('form.match');

//création de match par un user
Route::post('/match/insert', [MatchsController::class, 'insert'])->name('insert.match');

//Profil d'un match
Route::get('/match/{id}',[MatchsController::class, 'displayMatchProfile'])->name('displayMatchProfile');

//Formulaire d'édition d'un match
Route::get('/match/edit/{id}',[MatchsController::class, 'editMatchForm'])->name('editForm.match');

//Update d'un match
Route::post('/match/update',[MatchsController::class, 'matchUpdate'])->name('update.match');

//Delete d'un match
Route::get('/match/delete/{id}',[MatchsController::class, 'delete'])->name('delete.match');





//gestion des résultats
//vers le formulaire de création de résultat par un user
Route::get('/createResult/{match_id}/{championship_id}',[ResultController::class, 'resultForm'])->name('form.result');

//création de résultat par un user
Route::post('/result/insert', [ResultController::class, 'insert'])->name('insert.result');

//Formulaire d'édition d'un résultat
Route::get('/result/edit/{id}/{user_id}',[ResultController::class, 'editResultForm'])->name('editForm.result');

//Update d'un résultat
Route::post('/result/update',[ResultController::class, 'resultUpdate'])->name('update.result');

//Delete d'un résultat
Route::get('/result/delete/{id}',[ResultController::class, 'delete'])->name('delete.result');



//gestion des kills
//vers le formulaire de création de kill par un user
Route::get('/create-kill/{match_id}',[KillController::class, 'killForm'])->name('form.kill');

////création de kill par un user
//Route::post('/kill/insert', [KillController::class, 'insert'])->name('insert.kill');
//
////Formulaire d'édition d'un kill
//Route::get('/kill/edit/{id}/{user_id}',[KillController::class, 'editKillForm'])->name('editForm.result');
//
////Update d'un kill
//Route::post('/kill/update',[KillController::class, 'killUpdate'])->name('update.kill');
//
////Delete d'un kill
//Route::get('/kill/delete/{id}',[KillController::class, 'delete'])->name('delete.kill');















require __DIR__ . '/auth.php';
