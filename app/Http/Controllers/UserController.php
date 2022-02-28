<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\Deck;
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

        $this->avgPointsByMatch($id);

        return view('/player', [
            'id' => $id,
            'player' => $player,
            'decks' => $decks,
        ]);
    }

    public function averagePointsByMatchByChampionship($championshipId)
    {

        //Connexion
        $pdo = connect();

        $query = $pdo->prepare('

        SELECT AVG( r_score ) AS avg_score
        FROM milo_results
        INNER JOIN milo_matchs  ON milo_results.m_id = milo_matchs.m_id
        INNER JOIN milo_championships  ON milo_championships.c_id = milo_matchs.c_id
        WHERE milo_results.u_id = :userId AND milo_matchs.c_id = :championshipId
            ');
        $query->execute([
                ':userId' => self::getId(),
                ':championshipId' => $championshipId
            ]
        );
        $aData = $query->fetch(\PDO::FETCH_ASSOC);
        if ($aData) {

            return round($aData['avg_score'], 2);

        }
        return null;
    }

    	public function averagePointsByMatch(){

        //Connexion
        $pdo = connect();

        $query = $pdo->prepare('

        SELECT AVG( score ) AS avg_score
        FROM results
        WHERE results.user_id = :userId
        ');
		$query -> execute([
			':userId' =>  self::getId()
		]
		);
		$aData = $query->fetch(\PDO::FETCH_ASSOC);
		if ($aData) {
			return round($aData['avg_score'],2);
		}
		return null;
    }

    public function avgPointsByMatch($id)
    {
        $userMatchs = Result::query()->where('user_id', $id)->get();
        $userMatchs->selectRaw
        dd($userMatchs);
    }0000000000000000000000000000000000000000000000000000000000000000000000
00000000000000000000000000000000000000000O00000000000000000000000000000000000000SD0000Q0S0D0000SQ00000000000000000000000
0000000000000000000000000000000000000000000000000000000000000000000000000000
00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001000000000000000000200000000000000000032010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000QS000D00SQ00D00SQ0000000000000000A000000Z000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000

0                   000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000







































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
