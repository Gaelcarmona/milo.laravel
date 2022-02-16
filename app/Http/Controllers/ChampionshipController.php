<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Championship;
use \App\Http\Requests\CreateAndEditChampionshipRequest;
use App\Http\Controllers\Championship_UserController;
use \App\Http\Requests\CreateChampionshipUserRequest;
use App\Http\Controllers\Championship_User;

class ChampionshipController extends Controller
{
    public function championshipForm()
    {

        $associateUsers = Associate_User::query()->where('creator_id', '=', Auth::id())->get();

        return view('/createchampionship', ['associateUsers' => $associateUsers]);
    }



    public function insert(CreateAndEditChampionshipRequest $request)
    {
        $championship = new Championship();

        $championship->title = $request->input('title');
//        $user->creator_id = $request->input(Auth::id());
        $championship->user_id = Auth::id();
        $championship->save();

        $this->championshipUserInsert();


//        dd($users);
//        dd('coucou');
        return view('/user');

    }

        public function championshipUserInsert(){
        foreach ($_POST['player'] as $player){
//        dd($player);

        $championship = DB::table('championships')->latest('id')->first();
        $championshipUser = new App\Http\Controllers\Championship_User();

        $championshipUser->user_id = $request->input('player');
        $championshipUser->championship_id = $championship->id;

        $championshipUser->save();
        }


    }


}
