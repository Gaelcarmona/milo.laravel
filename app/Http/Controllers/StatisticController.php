<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Deck;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use App\Models\Kill;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statisticHome()
    {
        return view('/stats');
    }

    //affichage des joueurs
    public function displayPlayersStats()
    {
        $creators = User::query()->where('email', '!=', null)->get();

        $players = User::query()->get();


        $results_for_players = [];

        foreach ($players as $player) {

            $results = Result::query()->get();

            $results_for_player = $results
                ->where('user_id', $player->id);

            $results_for_players[] = $results_for_player;
        }

        $count = -1;

        $totalMatch = Matchs::query()
            ->get()->count();

        return view('/stats-players', [
            'players' => $players,
            'results_for_players' => $results_for_players,
            'count' => $count,
            'totalMatch' => $totalMatch,
            'results' => $results,
            'creators' => $creators,
        ]);
    }

    public function displayPlayerStats($player_id)
    {
        $decks = Deck::query()->where('user_id', '=', $player_id)->get();
        $player = User::query()
            ->with([
                'championships.matchs.results.user',
                'championships.matchs.results.kills.user',
                'championships.matchs.results.kills.result',
                'championships.users',
            ])
            ->where('id', $player_id)
            ->first();

        $Users = User::query()->get();

        $championships = $player->championships;

        $championshipsResults = $player->championships
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten();

        $results_for_player = $championshipsResults
            ->where('user_id', $player->id);

        $resultsOthersPlayers = $championshipsResults
            ->where('user_id', '!=', $player_id);

        //Total des fois ou un autre player a tué notre player, 2 versions
        $totalKillsByKiller = array_count_values($resultsOthersPlayers->pluck('kills')->flatten()
            ->where('user_killed_id', $player->id)
            ->pluck('result.user_id')
            ->toArray());

        //classement des players par nombre de kills
        $totalKills = $championshipsResults
            ->groupBy(function (Result $result) {
                return $result->user->id;
            })
            ->sortByDesc(function (Collection $collection) {
                return $collection->pluck('kills')->flatten()->count();
            })
            ->map(function (Collection $collection, $pseudo) {
                return $collection->pluck('kills')->flatten()->count();
            })
            ->toArray();

        $killRank = array_search($player_id, array_keys($totalKills)) + 1;

        $totalMatch = Matchs::query()
            ->get()->count();

        return view('/stats-player', [
            'id' => $player_id,
            'killRank' => $killRank,
            'player' => $player,
            'decks' => $decks,
            'userChampionships' => $championships,
            'results_for_player' => $results_for_player,
            'Users' => $Users,
            'results' => $resultsOthersPlayers,
            'totalKillsByKiller' => $totalKillsByKiller,
            'championshipsResults' => $championshipsResults,
            'totalMatch' => $totalMatch,
        ]);
    }

    public function displayChampionshipsStats()
    {
        $championships = Championship::query()
                    ->with([
                'user',
            ])
        ->get();
        return view('/stats-championships', [
            'championships' => $championships,
        ]);
    }

    public function displayChampionshipStats($championship_id)
    {

        $championship = Championship::query()->with('users.championships')->where('id', $championship_id)->first();
        $players = $championship->users()->with('championships.matchs.results')->get();

        $results_for_players = [];

        $matchs = Matchs::query()->where('championship_id', '=', $championship_id)->get();

        foreach ($players as $player) {

            $championshipResults = $player->championships
                ->where('id', $championship_id)
                ->pluck('matchs')->flatten()
                ->pluck('results')->flatten();

            $results_for_player = $championshipResults
                ->where('user_id', $player->id);
                // dd( $championshipResults->toArray());   
            $results_for_players[] = $results_for_player;
        }

        $count = -1;

        // $totalMatch =    DB::table('matchs')->where('championship_id', $championship_id)->count('id');

        $collect = $championshipResults->groupBy('deck_id');
        // dd($collect, $championshipResults);
        $decksId = $collect->keys()->toArray();
        $decks = [];
        foreach ($decksId as $deckId) {
            $deck = Deck::query()->where('id', $deckId)->with('user.championships')->first();
            $decks[] = $deck;
        }


        $results_for_decks = [];

        foreach ($decks as $deck) {

            $championshipResultsDeck = $deck->user->championships
                ->where('id', $championship_id)
                ->pluck('matchs')->flatten()
                ->pluck('results')->flatten();

            $results_for_deck = $championshipResultsDeck
                ->where('deck_id', $deck->id);

            $resultsOthersDecks = $championshipResultsDeck
                ->where('deck_id', '!=', $deck->id);
            
            $results_for_decks[] = $results_for_deck;
            
        }
        $totalMatchInChampionship =    DB::table('matchs')->where('championship_id', $championship_id)->count('id');

        $countDeck = -1;


        return view('/stats-championship', [
            'players' => $players,
            'championship' => $championship,
            'results_for_players' => $results_for_players,
            'count' => $count,
            'countDeck' => $countDeck,
            'totalMatch' => $totalMatchInChampionship,
            'championshipResults' => $championshipResults,
            'decks' => $decks,
            'championshipResultsDeck' => $championshipResultsDeck,
            'results_for_decks' => $results_for_decks,
            'resultsOthersDecks' => $resultsOthersDecks,
            'totalMatchInChampionship' => $totalMatchInChampionship,
            'matchs' => $matchs,
        ]);
    }

        //Stats d'un match
        public function displayMatchStats($match_id)
        {
            $results = Result::query()->where('match_id', '=', $match_id)->get();
    
            $match = Matchs::where('id', $match_id)->first();

            $championship = Championship::where('id',$match->championship_id)->first();
    
            $ids = [];
            foreach ($results as $result) {
                $ids[] = $result->id;
            }
    
            $killed_players = Kill::whereIn('result_id', $ids)->get();
    
            return view('/stats-match', [
                'id' => $match_id,
                'match' => $match,
                'results' => $results,
                'killed_players' => $killed_players,
                'championship' => $championship,
            ]);
        }


    public function displayPlayerStatsInChampionship($player_id, $championship_id)
    {
        $decks = Deck::query()->where('user_id', '=', $player_id)->get();
        $player = User::query()
            ->with([
                'championships.matchs.results.user',
                'championships.matchs.results.kills.user',
                'championships.matchs.results.kills.result',
                'championships.users',
            ])
            ->where('id', $player_id)
            ->first();

        $Users = User::query()->get();

        $championships = $player->championships;

        $championship = $player->championships->where('id', $championship_id)->first();

        $championshipResults = $player->championships
            ->where('id', $championship_id)
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten();

        $results_for_player = $championshipResults
            ->where('user_id', $player->id);

        $resultsOthersPlayers = $championshipResults
            ->where('user_id', '!=', $player_id);

        //Total des fois ou un autre player a tué notre player, 2 versions
        $totalKillsByKiller = array_count_values($resultsOthersPlayers->pluck('kills')->flatten()
            ->where('user_killed_id', $player->id)
            ->pluck('result.user_id')
            ->toArray());

        //classement des players par nombre de kills
        $totalKills = $championshipResults
            ->groupBy(function (Result $result) {
                return $result->user->id;
            })
            ->sortByDesc(function (Collection $collection) {
                return $collection->pluck('kills')->flatten()->count();
            })
            ->map(function (Collection $collection, $pseudo) {
                return $collection->pluck('kills')->flatten()->count();
            })
            ->toArray();

        $killRank = array_search($player_id, array_keys($totalKills)) + 1;

        $totalMatchInChampionship = Matchs::query()
            ->where('championship_id', $championship_id)
            ->get()->count();

        return view('/stats-player-in-championship', [
            'id' => $player_id,
            'killRank' => $killRank,
            'player' => $player,
            'decks' => $decks,
            'userChampionships' => $championships,
            'results_for_player' => $results_for_player,
            'Users' => $Users,
            'results' => $resultsOthersPlayers,
            'totalKillsByKiller' => $totalKillsByKiller,
            'championshipResults' => $championshipResults,
            'totalMatchInChampionship' => $totalMatchInChampionship,
            'championship' => $championship,
        ]);
    }


    //affichage des decks
    public function displayDecksStats()
    {

        $players = User::query()->get();
        $decks = Deck::query()->with('user')->get();

        $usersDecks = [];
        foreach ($players as $player) {
            $userDecks = Deck::query()->where('user_id', $player->id)->get();
            $usersDecks[] = $userDecks;
        }
        $countUserDecks = -1;




        $results_for_decks = [];

        foreach ($decks as $deck) {

            $championshipResultsDeck = $deck->user->championships
                ->pluck('matchs')->flatten()
                ->pluck('results')->flatten();

            $results_for_deck = $championshipResultsDeck
                ->where('deck_id', $deck->id);

            $totalMatch =    DB::table('matchs')->count('id');

            $results_for_decks[] = $results_for_deck;


        }

        $countDeck = -1;

        return view('/stats-decks', [
            'decks' => $decks,
            'results_for_decks' => $results_for_decks,
            'totalMatch' => $totalMatch,
            'countDeck' => $countDeck,
            'championshipResultsDeck' => $championshipResultsDeck,
            'players' => $players,
            'countUserDecks' => $countUserDecks,
            'usersDecks' => $usersDecks,
        ]);
    }


    public function displayDeckStats($deck_id)
    {
        $deck = Deck::query()
            ->with([
                'user.championships.matchs.results.user',
                'user.championships.matchs.results.kills.user',
                'user.championships.matchs.results.kills.result',
                'user.championships.users',
            ])
            ->where('id', $deck_id)
            ->first();

        $Decks = Deck::query()->get();

        $championships = $deck->user->championships;

        $championshipsResults = $deck->user->championships
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten();

        $results_for_deck = $championshipsResults
            ->where('deck_id', $deck->id);

        $resultsOthersDecks = $championshipsResults
            ->where('deck_id', '!=', $deck_id);

        $totalMatch = Matchs::query()
            ->get()->count();
          
        //toutes les fois ou le joueur a kill
        $deathsOfEachUsers = $results_for_deck->pluck('kills')->flatten()->groupBy('user_killed_id');
        $allKilledDecks =[];
        foreach ($deathsOfEachUsers as $deathsOfAnUser) {

            foreach ($deathsOfAnUser as $deathOfAnUser) {

                $result = Result::query()->where('id', $deathOfAnUser->result_id)->first();

                $killedResult = Result::query()->where('match_id', $result->match_id)
                ->where('user_id', $deathOfAnUser->user_killed_id)
                ->first();

                $killedDeck = Deck::query()->where('id', $killedResult->deck_id)->with('user')->first();
                
                $allKilledDecks[] = $killedDeck;
            }   
        }
        $result = [];
        foreach ($allKilledDecks as $killedDeck) {
            $result[$killedDeck->id][] = $killedDeck;
        }
        $allKilledDecks = $result;

        //toutes les fois ou le joueur a été kill
        $playerDeaths = Kill::query()->where('user_killed_id', $deck->user_id)->get();
        $allDeathsDecks =[];
        $totalDeaths = [];
        foreach ($playerDeaths as $playerDeath) {

            $resultOfKillerWhenPlayerIsKilled = Result::query()->where('id', $playerDeath->result_id)->first();
            $deathDeck = Deck::query()->where('id', $resultOfKillerWhenPlayerIsKilled->deck_id)->with('user')->first();
            
            $resultOfPlayerWhenPlayerIsKilled = Result::query()
            ->where('match_id', $resultOfKillerWhenPlayerIsKilled->match_id)
            ->where('user_id', $deck->user_id)
            ->where('deck_id', $deck_id)
            ->first();
            
            if ($resultOfPlayerWhenPlayerIsKilled) {
                $allDeathsDecks[] = $deathDeck;
                $totalDeaths[] = $resultOfPlayerWhenPlayerIsKilled;
            }
        } 
        $result = [];
        foreach ($allDeathsDecks as $DeathDeck) {
            $result[$DeathDeck->id][] = $DeathDeck;
        }
        $allDeathsDecks = $result;

        return view('/stats-deck', [
            'deck_id' => $deck_id,
            'deck' => $deck,
            'userChampionships' => $championships,
            'results_for_deck' => $results_for_deck,
            'Decks' => $Decks,
            'resultsOthersDecks' => $resultsOthersDecks,
            'allKilledDecks' => $allKilledDecks,
            'allDeathsDecks' => $allDeathsDecks,
            'totalMatch' => $totalMatch,
            'totalDeaths' => $totalDeaths,
        ]);
    }

    public function displayDeckStatsInChampionship($deck_id, $championship_id)
    {
        $deck = Deck::query()
            ->with([
                'user.championships.matchs.results.user',
                'user.championships.matchs.results.kills.user',
                'user.championships.matchs.results.kills.result',
                'user.championships.users',
            ])
            ->where('id', $deck_id)
            ->first();

        $decks = Deck::query()->get();

        $championships = $deck->user->championships;

        $championship = $deck->user->championships->where('id', $championship_id)->first();

        $championshipResults = $deck->user->championships
            ->where('id', $championship_id)
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten();

        $results_for_deck = $championshipResults
            ->where('deck_id', $deck->id);

        $resultsOthersDecks = $championshipResults
            ->where('deck_id', '!=', $deck_id);

        $totalMatchInChampionship = Matchs::query()
            ->where('championship_id', $championship_id)
            ->get()->count();

        //toutes les fois ou le joueur a kill
        $deathsOfEachUsers = $results_for_deck->pluck('kills')->flatten()->groupBy('user_killed_id');
        $allKilledDecks =[];
        foreach ($deathsOfEachUsers as $deathsOfAnUser) {

            foreach ($deathsOfAnUser as $deathOfAnUser) {

                $result = Result::query()->where('id', $deathOfAnUser->result_id)->first();

                $killedResult = Result::query()->where('match_id', $result->match_id)
                ->where('user_id', $deathOfAnUser->user_killed_id)
                ->first();

                $killedDeck = Deck::query()->where('id', $killedResult->deck_id)->with('user')->first();
                
                $allKilledDecks[] = $killedDeck;
            }   
        }
        $result = [];
        foreach ($allKilledDecks as $killedDeck) {
            $result[$killedDeck->id][] = $killedDeck;
        }
        $allKilledDecks = $result;

        //toutes les fois ou le joueur a été kill
        $playerDeaths = Kill::query()->where('user_killed_id', $deck->user_id)->get();
        $allDeathsDecks =[];
        $totalDeaths = [];
        foreach ($playerDeaths as $playerDeath) {

            $resultOfKillerWhenPlayerIsKilled = Result::query()->where('id', $playerDeath->result_id)->first();
            $deathDeck = Deck::query()->where('id', $resultOfKillerWhenPlayerIsKilled->deck_id)->with('user')->first();
            
            $resultOfPlayerWhenPlayerIsKilled = Result::query()
            ->where('match_id', $resultOfKillerWhenPlayerIsKilled->match_id)
            ->where('user_id', $deck->user_id)
            ->where('deck_id', $deck_id)
            ->with('match')
            ->first();
            
            if ($resultOfPlayerWhenPlayerIsKilled && $resultOfPlayerWhenPlayerIsKilled->match->championship_id == $championship_id) {
                $allDeathsDecks[] = $deathDeck;
                $totalDeaths[] = $resultOfPlayerWhenPlayerIsKilled;
            }
        } 
        $result = [];
        foreach ($allDeathsDecks as $DeathDeck) {
            $result[$DeathDeck->id][] = $DeathDeck;
        }
        $allDeathsDecks = $result;

        return view('/stats-deck-in-championship', [
            'deck_id' => $deck_id,
            'deck' => $deck,
            'decks' => $decks,
            'userChampionships' => $championships,
            'results_for_deck' => $results_for_deck,
            'resultsOthersDecks' => $resultsOthersDecks,
            'championshipResults' => $championshipResults,
            'totalMatchInChampionship' => $totalMatchInChampionship,
            'championship' => $championship,
            'allKilledDecks' => $allKilledDecks,
            'allDeathsDecks' => $allDeathsDecks,
            'totalDeaths' => $totalDeaths,
        ]);
    }
}
