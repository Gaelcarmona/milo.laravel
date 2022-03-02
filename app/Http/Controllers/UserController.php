<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\Championship;
use App\Models\Deck;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Http\Requests\CreateAndEditUserRequest;
use \App\Http\Requests\CreateAndEditPlayerRequest;

class UserController extends Controller
{
    public function insert(CreateAndEditUserRequest $request)
    {

        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return view('/login');
    }

    public function update(CreateAndEditUserRequest $request, $id)
    {
        User::where('id', $id)->update([

            'pseudo' => $request->input('pseudo'),
            "email" => $request->input('email'),
            "password" => $request->input('password')]);

        return view('/admin');
    }

    public function delete($id)
    {

        $test = Associate_User::query()->where('creator_id', Auth::id())->get();

        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        $associateUserToDelete = DB::raw("DELETE FROM associate_user WHERE user_id = $id");
        DB::statement($associateUserToDelete);

        return redirect()->route('players', ['associateUsers' => $associateUsers]);
    }

    public function playerInsert(CreateAndEditPlayerRequest $request)
    {
        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->save();
        $this->associateUserInsert($user);

        return redirect()->route('players', ['associateUsers' => $associateUsers]);
//        return view('/players', ['associateUsers' => $associateUsers]);
    }

    public function associateUserInsert(User $user)
    {
        $user->users()->syncWithoutDetaching(Auth::id());
    }

    //affichage des joueurs créés par l'user
    public function displayPlayers()
    {
        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        return view('/players', [
            'associateUsers' => $associateUsers,
            'user_creator' => $user_creator,
        ]);
    }

    //formulaire d'édition d'un player
    public function editPlayerForm($id)
    {
        $playerBread = User::query()->where('id', $id)->first();

        return view('playerEdit', [
            'id' => $id,
            'playerBread' => $playerBread,
        ]);
    }


    public function playerUpdate(CreateAndEditPlayerRequest $request)
    {

        $user = User::where('id', $request->request->get('id'))->first();
        $user->pseudo = $request->request->get('pseudo');
        $user->save();

        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        return view('/players', ['associateUsers' => $associateUsers]);
    }


    public function displayPlayerProfile($player_id)
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

        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        $championships = $player->championships;


        $championshipsResults = $player->championships
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten();

        $results_for_player = $championshipsResults
            ->where('user_id', $player->id);

        $resultsOthersPlayers = $championshipsResults
            ->where('user_id', '!=', $player_id);

        //Pourcentage de victoire
        $percentWin = $this->percentWin($player_id);

        //Pourcentage de participation
        $percentParticipation = $this->percentParticipation($player_id);

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


        //Stats par championnat
        foreach ($championships as $championship) {
            $championshipResults = $player->championships
                ->where('id', $championship->id)
                ->pluck('matchs')->flatten()
                ->pluck('results')->flatten();

            $results_for_player_in_championship = $championshipResults
                ->where('user_id', $player->id);

            //classement des players par nombre de kills
            $totalKillsByChampionship = $championshipResults
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

            $killRankByChampionship = array_search($player_id, array_keys($totalKillsByChampionship)) + 1;

            $resultsOthersPlayersInChampionship = $championshipsResults
                ->where('id', $championship->id)
                ->where('user_id', '!=', $player_id);

            $championship = Championship::query()->where('id', '=', $championship->id)->first();
            $championshipUsers = $championship->users()->get();

            //Total des fois ou un autre player a tué notre player dans un chmpionnat
            $totalKillsByKillerInChampionship = array_count_values($resultsOthersPlayersInChampionship->pluck('kills')->flatten()
                ->where('user_killed_id', $player->id)
                ->pluck('result.user_id')
                ->toArray());
//            dd($championshipUsers);
        }


        return view('/player', [
            'id' => $player_id,
            'killRank' => $killRank,
            'player' => $player,
            'decks' => $decks,
            'userChampionships' => $championships,
            'percentWin' => $percentWin,
            'percentParticipation' => $percentParticipation,
            'results_for_player' => $results_for_player,
            'associateUsers' => $associateUsers,
            'user_creator' => $user_creator,
            'results' => $resultsOthersPlayers,
            'totalKillsByKiller' => $totalKillsByKiller,
            'championshipsResults' => $championshipsResults,
            'results_for_player_in_championship' => $results_for_player_in_championship,
            'championshipResults' => $championshipResults,
            'killRankByChampionship' => $killRankByChampionship,
            'resultsOthersPlayersInChampionship' => $resultsOthersPlayersInChampionship,
            'championshipUsers' => $championshipUsers,
            'totalKillsByKillerInChampionship' => $totalKillsByKillerInChampionship,
        ]);
    }


    /**
     * Pourcentage de victoire
     *
     * @param $id
     * @return float
     */
    public function percentWin($id)
    {
        $totalWins = Result::query()
            ->where('user_id', $id)
            ->where('place', 1)
            ->selectRaw('count(place) as totalWins')
            ->get();
        $totalMatchsPlayed = Result::query()
            ->where('user_id', $id)
            ->selectRaw('count(*) as totalMatchsPlayed')
            ->get();

        $percentWin = round(($totalWins[0]->totalWins / $totalMatchsPlayed[0]->totalMatchsPlayed) * 100, 1);

        return $percentWin;
    }

    //Pourcentage de participation

    /**
     *
     *
     * @param $id
     * @return float
     */
    public function percentParticipation($id): float
    {
        $totalMatchs = Matchs::query()
            ->selectRaw('count(*) as totalMatchs')
            ->get();
        $totalMatchsPlayed = Result::query()
            ->where('user_id', $id)
            ->selectRaw('count(*) as totalMatchsPlayed')
            ->get();

        $percentParticipation = round(($totalMatchsPlayed[0]->totalMatchsPlayed / $totalMatchs[0]->totalMatchs) * 100, 1);

        return $percentParticipation;
    }

    //Calcul ELO : (nombreDeVictoires + totalDeKills)+(nombreDeDeuxiemePlace /2 ) +(nombreDeTroisiemePlace /3 )/pourcentageDeParticipation
    //LES KILLS


//    public function averagePointsByMatchByChampionship($user_id)
//    {
//        $user = User::query()->where('id', $user_id)->first();
//        $userChampionships = $user->championships()->get();
//
//        $results = [];
//        foreach ($userChampionships as $userChampionship) {
//            $matchs = Matchs::query()->where('championship_id', $userChampionship->id)->get();
//            $result = Result::query()
//                ->where('user_id', $user_id)
//                ->whereIn('match_id', $matchs->pluck('id')->toArray())
//                ->selectRaw('avg(score)')
//                ->get();
//
//            $results[] = $result;
//
//
//        }
////            dd($results);
////
////
////        $championship = Championship::where('id', $championship_id)->first();
////        $championshipUsers = $championship->users()->get();
////
////        $query = $pdo->prepare('
////
////        SELECT AVG( r_score ) AS avg_score
////        FROM milo_results
////        INNER JOIN milo_matchs  ON milo_results.m_id = milo_matchs.m_id
////        INNER JOIN milo_championships  ON milo_championships.c_id = milo_matchs.c_id
////        WHERE milo_results.u_id = :userId AND milo_matchs.c_id = :championshipId
////            ');
////        $query->execute([
////                ':userId' => self::getId(),
////                ':championshipId' => $championshipId
////            ]
////        );
//        return $userChampionships;
//    }

}
