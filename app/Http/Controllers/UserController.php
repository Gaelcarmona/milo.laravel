<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\Deck;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
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


    public function displayPlayerProfile($id)
    {
        $decks = Deck::query()->where('user_id', '=', $id)->get();
        $player = User::query()
            ->with('championships.matchs.results.kills')
            ->where('id', $id)
            ->first();

//        $user = User::query()->where('id', $user_id)->first();
        $userChampionships = $player->championships;

        $results_for_player = $player->championships
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten()
//            ->pluck('kills')->flatten()
            ->where('user_id', $player->id);

//        dump(
//            $results_for_player->pluck('kills')->flatten()->count() / $results_for_player->count(),
//        );

        //Pourcentage de victoire
        $percentWin = $this->percentWin($id);

        //Pourcentage de participation
        $percentParticipation = $this->percentParticipation($id);


        return view('/player', [
            'id' => $id,
            'player' => $player,
            'decks' => $decks,
            'userChampionships' => $userChampionships,
            'percentWin' => $percentWin,
            'percentParticipation' => $percentParticipation,
            'results_for_player' => $results_for_player,
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
