<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Matchs;
use App\Http\Controllers\Championship_UserController;
use App\Models\Championship_User;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use \App\Http\Requests\CreateAndEditResultRequest;

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


    //Insertion d'un résultat pour un joueur
    public function insert(CreateAndEditResultRequest $request)
    {
//        dd($request);
        $result = new Result();
//dd($result);
        $result->user_id = $request->input('user_id');
        $result->deck_id = $request->input('deck_id');
        $result->match_id = $request->input('match_id');
        $result->place = $request->input('place');

        if ($request->input('place') === 1){
            $result->score = 7;
        }elseif ($request->input('place') === 2){
            $result->score = 5;
        }elseif ($request->input('place') === 3){
            $result->score = 3;
        }elseif ($request->input('place') === 4){
            $result->score = 2;
        }elseif ($request->input('place') === 5){
            $result->score = 1;
        }elseif ($request->input('place') === 6){
            $result->score = 0;
        }
//        dd($result);

        $result->save();

        return redirect()->route('displayMatchProfile', ['id' => $result->match_id]);

    }


}
