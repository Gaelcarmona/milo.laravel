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

        return view('/createResult'
            , [
                'championshipId' => $championshipId,
                'users' => $users,
                'match_id' => $match_id,
                'players' => $players,
            ]);
    }


    //Insertion d'un résultat pour un joueur
    public function insert(CreateAndEditResultRequest $request)
    {
        $result = new Result();

        $result->user_id = $request->input('user_id');
        $result->deck_id = $request->input('deck_id');
        $result->match_id = $request->input('match_id');
        $result->place = $request->input('place');

        if ($request->input('place')) {
            $scorePlaceEquivalence = [
                1 => 7,
                2 => 5,
                3 => 3,
                4 => 2,
                5 => 1,
                6 => 0,
            ];
            $result->score = $scorePlaceEquivalence[$request->input('place')];
        }

        $result->save();

        return redirect()->route('displayMatchProfile', ['id' => $result->match_id]);

    }


    //formulaire d'édition d'un résultat
    public function editResultForm($id, $user_id)
    {
        $decksUser = Deck::query()->where('user_id', '=', $user_id)->get();
        $match_id = Matchs::query()->where('id', '=', $id)->get();
        return view('resultEdit', [
            'id' => $id,
            'decksUser' => $decksUser,
            'user_id' => $user_id,
            'match_id' => $match_id,
        ]);
    }


    //Update d'un résultat
    public function resultUpdate(CreateAndEditResultRequest $request)
    {

        $result = Result::where('id', $request->request->get('id'))->first();

        $result->deck_id = $request->input('deck_id');
        $result->place = $request->input('place');

        if ($request->input('place')) {
            $scorePlaceEquivalence = [
                1 => 7,
                2 => 5,
                3 => 3,
                4 => 2,
                5 => 1,
                6 => 0,
            ];
            $result->score = $scorePlaceEquivalence[$request->input('place')];
        }

        $result->save();

        return redirect('/championships');
    }


    //suppression d'un résultat
    public function delete($id)
    {
        Result::where('id', $id)->delete();
        return redirect('/championships');
    }


}
