<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Championship_User;
use App\Models\Associate_User;
use Illuminate\Http\Request;
use \App\Http\Requests\CreateChampionshipUserRequest;

class Championship_UserController extends Controller
{
    public function championshipUserInsert(CreateChampionshipUserRequest $request)
    {

        foreach ($_POST['player'] as $player) {

            $championship = DB::table('championships')->latest('id')->first();
            $championshipUser = new Championship_User();

            $championshipUser->user_id = $request->input('player');
            $championshipUser->championship_id = $championship->id;

            $championshipUser->save();
        }


    }

    public function formPlayerInChampionship($championship_id)
    {
        $associateUsers = Associate_User::query()->where('creator_id', '=', Auth::id())->get();
//    dd($associateUsers);

        return view('/form-player-in-championship', [
            'associateUsers' => $associateUsers,
            'championship_id' => $championship_id,
        ]);

    }

    public function insert(CreateChampionshipUserRequest $request)
    {
        $championshipUser = new Championship_User();

        $championshipUser->user_id = $request->input('user_id');
        $championshipUser->championship_id = $request->input('championship_id');

        $championshipUser->save();

        return redirect('/championships');

    }

    public function delete($user_id, $championship_id)
    {
        Championship_User::where('user_id', $user_id)
            ->where('championship_id', $championship_id)
            ->delete();
        return redirect('/championships');
    }

}
