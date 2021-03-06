<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\Championship_UserController;
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
})->name('accueil');

Route::middleware('auth')->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

//logout
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//vers le profil utilisateur
    Route::get('/user', function () {
        return view('user');
    })->name('user');

    //vers le compte d'un utilisateur
    Route::get('/account-user/{id}', [UserController::class, 'accountUser'])->name('account.user');


    //Gestion des users
    //vers le formulaire de modification d'un user
    Route::get('/user-edit/{id}', [UserController::class, 'formUpdateUser'])->name('form.update.user');

    //Update d'un user
    Route::post('/user/update', [UserController::class, 'userUpdate'])->name('update.user');

    //Delete d'un joueur
    Route::get('/user/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');


    //Gestion des joueurs
//vers le formulaire de création de joueurs par un user
    Route::get('/createplayer', function () {
        return view('createplayer');
    })->name('createplayer');

//création de joueurs par un user
    Route::post('/player/insert', [UserController::class, 'playerInsert'])->name('insert.player');

//Affichage des joueurs
    Route::get('/players', [UserController::class, 'displayPlayers'])->name('players');

//Formulaire d'édition d'un joueur
    Route::get('/player/edit/{id}', [UserController::class, 'editPlayerForm'])->name('editPlayer');

//Update d'un joueur
    Route::post('/player/update', [UserController::class, 'playerUpdate'])->name('update.player');

//Delete d'un joueur
    Route::get('/player/delete/{id}', [UserController::class, 'delete'])->name('player.delete');

//Profil d'un joueur
    Route::get('/player/{id}', [UserController::class, 'displayPlayerProfile'])->name('displayPlayerProfile');


//gestion des championnats
//vers le formulaire de création de championnat par un user
    Route::get('/createchampionship', [ChampionshipController::class, 'championshipForm'])->name('create.championship');

//création de championnat par un user
    Route::post('/championship/insert', [ChampionshipController::class, 'insert'])->name('insert.championship');

//Affichage des championnats
    Route::get('/championships', [ChampionshipController::class, 'displayChampionships'])->name('championships');

//Profil d'un championnat
    Route::get('/championship/{id}', [ChampionshipController::class, 'displayChampionshipProfile'])->name('displayChampionshipProfile');

//Formulaire d'édition d'un championnat
    Route::get('/championship/edit/{id}', [ChampionshipController::class, 'editChampionshipForm'])->name('editChampionship');

//Update d'un championnat
    Route::post('/championship/update', [ChampionshipController::class, 'championshipUpdate'])->name('update.championship');

//Delete d'un championnat
    Route::get('/championship/delete/{id}', [ChampionshipController::class, 'delete'])->name('championship.delete');


//gestion des joueurs dans un championnat
//Vers le formulaire d'ajout de joueur dans un championnat
    Route::get('/form-player-in-championship/{championship_id}', [Championship_UserController::class, 'formPlayerInChampionship'])->name('form.player.in.championship');

//ajout d'un joueur dans un championnat
    Route::post('/championship/insert-player', [Championship_UserController::class, 'insert'])->name('insert.player.in.championship');

//Delete d'un joueur dans un championnat
    Route::get('/championship/delete-player/{user_id}/{championship_id}', [Championship_UserController::class, 'delete'])->name('delete.player.in.championship');


//gestion des decks
//vers le formulaire de création de deck par un joueur
    Route::get('/createDeck/{id}', [DeckController::class, 'deckForm'])->name('form.deck');

//création de deck par un joueur
    Route::post('/deck/insert', [DeckController::class, 'insert'])->name('insert.deck');

//Profil d'un deck
    Route::get('/deck/{id}', [DeckController::class, 'displayDeckProfile'])->name('displayDeckProfile');

//Formulaire d'édition d'un deck
    Route::get('/deck/edit/{id}', [DeckController::class, 'editDeckForm'])->name('editForm.deck');

//Update d'un deck
    Route::post('/deck/update', [DeckController::class, 'deckUpdate'])->name('update.deck');

//Delete d'un deck
    Route::get('/deck/delete/{id}', [DeckController::class, 'delete'])->name('delete.deck');


//gestion des matchs
//vers le formulaire de création de match par un user
    Route::get('/createMatch/{id}', [MatchsController::class, 'matchForm'])->name('form.match');

//création de match par un user
    Route::post('/match/insert', [MatchsController::class, 'insert'])->name('insert.match');

//Profil d'un match
    Route::get('/match/{id}', [MatchsController::class, 'displayMatchProfile'])->name('displayMatchProfile');

//Formulaire d'édition d'un match
    Route::get('/match/edit/{id}', [MatchsController::class, 'editMatchForm'])->name('editForm.match');

//Update d'un match
    Route::post('/match/update', [MatchsController::class, 'matchUpdate'])->name('update.match');

//Delete d'un match
    Route::get('/match/delete/{id}', [MatchsController::class, 'delete'])->name('delete.match');


//gestion des résultats
//vers le formulaire de création de résultat par un user
    Route::get('/createResult/{match_id}/{championship_id}', [ResultController::class, 'resultForm'])->name('form.result');

//création de résultat par un user
    Route::post('/result/insert', [ResultController::class, 'insert'])->name('insert.result');

//Formulaire d'édition d'un résultat
    Route::get('/result/edit/{id}/{user_id}', [ResultController::class, 'editResultForm'])->name('editForm.result');

//Update d'un résultat
    Route::post('/result/update', [ResultController::class, 'resultUpdate'])->name('update.result');

//Delete d'un résultat
    Route::get('/result/delete/{id}', [ResultController::class, 'delete'])->name('delete.result');


//gestion des kills
//vers le formulaire de création de kill par un user
    Route::get('/create-kill/{result_id}/{match_id}', [KillController::class, 'killForm'])->name('form.kill');

////création de kill par un user
    Route::post('/kill/insert', [KillController::class, 'insert'])->name('insert.kill');

//Delete d'un kill
    Route::get('/kill/delete/{result_id}/{user_killed_id}', [KillController::class, 'delete'])->name('delete.kill');


    //Les images
////attribution d'une image pour un joueur
    Route::post('/player/{id}', [UserController::class, 'insertImagePlayer'])->name('insert.image.player');
    ////attribution d'une image pour un deck
    Route::post('/deck/{id}', [DeckController::class, 'insertImageDeck'])->name('insert.image.deck');
    //Insertion d'images
//vers le formulaire d'insertion
    Route::get('imageUpload', [ImageUploadController::class, 'imageUpload'])->name('image.upload');
//insertion
    Route::post('image-upload', 'ImageUploadController@imageUploadPost')->name('image.upload.post');


});


//Gestion des stats
//Vers la page d'accueil des stats
Route::get('/stats', [StatisticController::class, 'statisticHome'])->name('statistic.home');

//Vers les joueurs
Route::get('/stats-players', [StatisticController::class, 'displayPlayersStats'])->name('statistic.players');

//Vers un joueur pour affichage stats globales
Route::get('/stats-player/{user_id}', [StatisticController::class, 'displayPlayerStats'])->name('statistic.player');

//Vers un joueur pour affichage stats par championnat
Route::get('/stats-player-in-championship/{user_id}/{championship_id}', [StatisticController::class, 'displayPlayerStatsInChampionship'])->name('statistic.playerInChampionship');

//Vers les championnats
Route::get('/stats-championships', [StatisticController::class, 'displayChampionshipsStats'])->name('statistic.championships');

//Vers un championnat
Route::get('/stats-championship/{championship_id}', [StatisticController::class, 'displayChampionshipStats'])->name('statistic.championship');

//Vers un match
Route::get('/stats-match/{match_id}', [StatisticController::class, 'displayMatchStats'])->name('statistic.match');

//Vers les decks
Route::get('/stats-decks', [StatisticController::class, 'displayDecksStats'])->name('statistic.decks');

//Vers un deck pour affichage stats globales
Route::get('/stats-deck/{deck_id}', [StatisticController::class, 'displayDeckStats'])->name('statistic.deck');

//Vers un deck pour affichage stats par championnat
Route::get('/stats-deck-in-championship/{user_id}/{championship_id}', [StatisticController::class, 'displayDeckStatsInChampionship'])->name('statistic.deck.in.championship');


require __DIR__ . '/auth.php';
