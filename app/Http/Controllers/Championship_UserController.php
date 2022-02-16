<?php

namespace App\Http\Controllers;

use App\Models\Championship_User;
use Illuminate\Http\Request;
use \App\Http\Requests\CreateChampionshipUserRequest;

class Championship_UserController extends Controller
{
    public function championshipUserInsert(CreateChampionshipUserRequest $request){

        foreach ($_POST['player'] as $player){

        $championship = DB::table('championships')->latest('id')->first();
        $championshipUser = new App\Http\Controllers\Championship_User();

        $championshipUser->user_id = $request->input('player');
        $championshipUser->championship_id = $championship->id;

        $championshipUser->save();
        }


    }
}
