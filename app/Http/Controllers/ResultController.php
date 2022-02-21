<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Matchs;
use App\Http\Controllers\Championship_UserController;
use App\Models\Championship_User;
use App\Models\User;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //vers le formulaire de création de match par un user
    public function resultForm($match_id, $championshipId)
    {
        $players = Championship_User::query()->where('championship_id', '=', $championshipId)->get();

        $users = [];

        foreach ($players as $player) {
            $user = User::where('id', $player->user_id)->first();
            $users[] = $user;

        }

//        $decksUser = Deck::query()->whereIn('user_id', collect($users)->pluck('id'))->get();
//        dd($decks);

        return view('/createResult'
            , [
                'championshipId' => $championshipId,
                'users' => $users,
                'match_id' => $match_id,
                'players' => $players,
//                'decksUser'=> $decksUser,
            ]);
    }


}
