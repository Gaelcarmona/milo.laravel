<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\Deck;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        return view('/players', ['associateUsers' => $associateUsers]);
    }

    public function playerInsert(CreateAndEditPlayerRequest $request)
    {
        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->save();
        $this->associateUserInsert($user);


        return view('/players', ['associateUsers' => $associateUsers]);
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

        return view('/players', ['associateUsers' => $associateUsers]);
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
        $player = User::where('id', $id)->first();

//        $user = User::query()->where('id', $user_id)->first();
        $userChampionships = $player->championships()->get();

        //Score moyen
        $avgPointsByMatch = $this->avgPointsByMatch($id);
        //Place moyenne
        $avgPlaceByMatch = $this->avgPlaceByMatch($id);
        //Total points
        $sumPoints = $this->sumPoints($id);
        //Nombre de victoires
        $totalWins = $this->totalWins($id);
        //Total des matchs joués
        $totalMatchsPlayed = $this->totalMatchsPlayed($id);
        //Total seconde place
        $totalSecondPlace = $this->totalSecondPlace($id);
        //Total troisième place
        $totalThirdPlace = $this->totalThirdPlace($id);
        //Total quatrième place
        $totalFourthPlace = $this->totalFourthPlace($id);
        //Total cinquième place
        $totalFifthPlace = $this->totalFifthPlace($id);
        //Total sixième place
        $totalSixthPlace = $this->totalSixthPlace($id);

        //Pourcentage de victoire
//        $percentWin = ($totalWins/$totalMatchsPlayed)*100;


        $averagePointsByMatchByChampionship = $this->averagePointsByMatchByChampionship($id);

//      dump($userChampionships);
        return view('/player', [
            'id' => $id,
            'player' => $player,
            'decks' => $decks,
            'avgPointsByMatch' => $avgPointsByMatch,
            'averagePointsByMatchByChampionship' => $averagePointsByMatchByChampionship,
            'userChampionships' => $userChampionships,
            'avgPlaceByMatch' => $avgPlaceByMatch,
            'sumPoints' => $sumPoints,
            'totalWins' => $totalWins,
            'totalMatchsPlayed' => $totalMatchsPlayed,
            'totalSecondPlace' => $totalSecondPlace,
            'totalThirdPlace' => $totalThirdPlace,
            'totalFourthPlace' => $totalFourthPlace,
            'totalFifthPlace' => $totalFifthPlace,
            'totalSixthPlace' => $totalSixthPlace,
        ]);
    }

//    public function averagePointsByMatchByChampionship($championshipId)
//    {
//
//        //Connexion
//        $pdo = connect();
//
//        $query = $pdo->prepare('
//
//        SELECT AVG( r_score ) AS avg_score
//        FROM milo_results
//        INNER JOIN milo_matchs  ON milo_results.m_id = milo_matchs.m_id
//        INNER JOIN milo_championships  ON milo_championships.c_id = milo_matchs.c_id
//        WHERE milo_results.u_id = :userId AND milo_matchs.c_id = :championshipId
//            ');
//        $query->execute([
//                ':userId' => self::getId(),
//                ':championshipId' => $championshipId
//            ]
//        );
//        $aData = $query->fetch(\PDO::FETCH_ASSOC);
//        if ($aData) {
//
//            return round($aData['avg_score'], 2);
//
//        }
//        return null;
//    }

    public function averagePointsByMatchByChampionship($user_id)
    {
        $user = User::query()->where('id', $user_id)->first();
        $userChampionships = $user->championships()->get();

        $results = [];
        foreach ($userChampionships as $userChampionship) {
            $matchs = Matchs::query()->where('championship_id', $userChampionship->id)->get();
            $result = Result::query()
                ->where('user_id', $user_id)
                ->whereIn('match_id', $matchs->pluck('id')->toArray())
                ->selectRaw('avg(score)')
                ->get();

            $results[] = $result;


        }
//            dd($results);
//
//
//        $championship = Championship::where('id', $championship_id)->first();
//        $championshipUsers = $championship->users()->get();
//
//        $query = $pdo->prepare('
//
//        SELECT AVG( r_score ) AS avg_score
//        FROM milo_results
//        INNER JOIN milo_matchs  ON milo_results.m_id = milo_matchs.m_id
//        INNER JOIN milo_championships  ON milo_championships.c_id = milo_matchs.c_id
//        WHERE milo_results.u_id = :userId AND milo_matchs.c_id = :championshipId
//            ');
//        $query->execute([
//                ':userId' => self::getId(),
//                ':championshipId' => $championshipId
//            ]
//        );
        return $userChampionships;
    }

    public function avgPointsByMatch($id)
    {
        $userMatchs = Result::query()->where('user_id', $id)
            ->selectRaw('avg(score) as score')
            ->get();
        return $userMatchs;
    }

    public function sumPoints($id)
    {
        $userMatchs = Result::query()->where('user_id', $id)
            ->selectRaw('sum(score) as totalScore')
            ->get();
        return $userMatchs;
    }

    public function totalWins($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->where('place', 1)
            ->selectRaw('count(place) as totalWins')
            ->get();
        return $userMatchs;
    }

    public function totalSecondPlace($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->where('place', 2)
            ->selectRaw('count(place) as totalSecondPlace')
            ->get();
        return $userMatchs;
    }

//
    public function totalThirdPlace($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->where('place', 3)
            ->selectRaw('count(place) as totalThirdPlace')
            ->get();
        return $userMatchs;
    }

    public function totalFourthPlace($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->where('place', 4)
            ->selectRaw('count(place) as totalFourthPlace')
            ->get();
        return $userMatchs;
    }

    public function totalFifthPlace($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->where('place', 5)
            ->selectRaw('count(place) as totalFifthPlace')
            ->get();
        return $userMatchs;
    }

    public function totalSixthPlace($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->where('place', 6)
            ->selectRaw('count(place) as totalSixthPlace')
            ->get();
        return $userMatchs;
    }


    public function totalMatchsPlayed($id)
    {
        $userMatchs = Result::query()
            ->where('user_id', $id)
            ->selectRaw('count(*) as totalMatchsPlayed')
            ->get();
        return $userMatchs;
    }

    public function avgPlaceByMatch($id)
    {
        $userMatchs = Result::query()->where('user_id', $id)
            ->selectRaw('avg(place) as place')
            ->get();
        return $userMatchs;
    }












































//    public function login(){
//
//        if (!empty ( $_POST ) )  {
//            $oUser =  app\Models\User::find($_POST['pseudo']);
//
//            if ($oUser == NULL) {
//                return view('/login');
//            }
//
//            if (password_verify($_POST['password'], $oUser->getPass())) {
//                $_SESSION['username'] = $oUser->getPseudo();
//                $_SESSION['id'] = $oUser->getId();
//                return view('/login/{id}');
//            }
//        }
//    }
}
