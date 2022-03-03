<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Deck;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    public function statisticHome()
    {
        return view('/stats');
    }

    //affichage des joueurs
    public function displayPlayersStats()
    {
        $users = User::query()->get();
//        dd($users);
//        $associateUsers = $user_creator->user()->get();

        return view('/stats-players', [
            'users' => $users,
//            'user_creator' => $user_creator,
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
        $championships = Championship::query()->get();
        return view('/stats-championships', [
            'championships' => $championships,
        ]);
    }

    public function displayChampionshipStats($championship_id)
    {

        $championship = Championship::query()->where('id', $championship_id)->first();
        $players = $championship->users()->get();
//        dd($championship->users()->get());


        return view('/stats-championship', [
            'players' => $players,
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

//        //Pourcentage de victoire
//        $percentWinInChampionship = $this->percentWinInChampionship($player_id, $championship_id);
//
//        //Pourcentage de participation
//        $percentParticipationInChampionship = $this->percentParticipationInChampionship($player_id);

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

//        dd($totalMatchInChampionship);

        return view('/stats-player-in-championship', [
            'id' => $player_id,
            'killRank' => $killRank,
            'player' => $player,
            'decks' => $decks,
            'userChampionships' => $championships,
//            'percentWinInChampionship' => $percentWinInChampionship,
//            'percentParticipationInChampionship' => $percentParticipationInChampionship,
            'results_for_player' => $results_for_player,
            'Users' => $Users,
            'results' => $resultsOthersPlayers,
            'totalKillsByKiller' => $totalKillsByKiller,
            'championshipResults' => $championshipResults,
            'totalMatchInChampionship' => $totalMatchInChampionship,
            'championship' => $championship,
        ]);
    }
}
