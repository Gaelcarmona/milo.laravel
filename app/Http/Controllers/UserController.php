<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\Deck;
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
        User::where('id', $id)->delete();

        $associateUsers = Associate_User::query()->where('creator_id', '=', Auth::id())->get();

        return view('/players', ['associateUsers' => $associateUsers]);
//        return view('/user');
    }

    public function playerInsert(CreateAndEditPlayerRequest $request)
    {
        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->save();
        $this->associateUserInsert();

        $associateUsers = Associate_User::query()->where('creator_id', '=', Auth::id())->get();

        return view('/players', ['associateUsers' => $associateUsers]);
    }

    public function associateUserInsert()
    {
        $user = DB::table('users')->latest('id')->first();

        $associateUser = new Associate_User();
        $associateUser->creator_id = Auth::id();
        $associateUser->user_id = $user->id;

        $associateUser->save();
    }

    //affichage des joueurs créés par l'user
    public function displayPlayers()
    {

        $associateUsers = Associate_User::query()->where('creator_id', '=', Auth::id())->get();

        return view('/players', ['associateUsers' => $associateUsers]);
    }

    //formulaire d'édition d'un player
    public function editPlayerForm($id)
    {
        $playerBread = User::query()->where('id',$id)->first();

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

        $associateUsers = Associate_User::query()->where('creator_id', '=', Auth::id())->get();

        return view('/players', ['associateUsers' => $associateUsers]);
    }

    public function displayPlayerProfile($id)
    {
        $decks = Deck::query()->where('user_id', '=', $id)->get();
        $player = User::where('id', $id)->first();

        return view('/player', [
            'id' => $id,
            'player' => $player,
            'decks' => $decks,
        ]);
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
