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
        $decks = [];

        foreach ($players as $player) {
            $user = User::where('id', $player->user_id)->first();
            $users[] = $user;

            $decksUser = Deck::query()->where('user_id', '=', $player->user_id)->get();
            $decks[] = $decksUser;
        }
        dd($decksUser);


        return view('/createResult'
            , [
                'championshipId' => $championshipId,
                'users' => $users,
                'match_id' => $match_id,
                'players' => $players,
            ]);
    }
}
