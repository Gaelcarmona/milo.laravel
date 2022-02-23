<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\Matchs;
use App\Models\Kill;
use App\Models\Championship;
use App\Models\User;
use \App\Http\Requests\CreateAndEditMatchRequest;

class MatchsController extends Controller
{
    //vers le formulaire de création de match par un user
    public function matchForm($id)
    {
//        dd($matchs);
        $championship = Championship::where('id', $id)->first();
        return view('/createMatch'
            , [
                'championship' => $championship]);
    }


    //création de match par un user
    public function insert(CreateAndEditMatchRequest $request)
    {
        $match = new Matchs();
        $match->title = $request->input('title');
        $match->championship_id = $request->input('championship_id');
        $match->save();

        return redirect()->route('displayChampionshipProfile', ['id' => $match->championship_id]);

    }

    //Profil d'un match
    public function displayMatchProfile($id)
    {
        $results = Result::query()->where('match_id', '=', $id)->get();

        $match = Matchs::where('id', $id)->first();

        $ids = [];
        foreach ($results as $result){
            $ids[] = $result->id;
        }

        $killed_players = Kill::whereIn('result_id', $ids)->get();
//        dd($killed_players);

        return view('/match', [
            'id' => $id,
            'match' => $match,
            'results' => $results,
            'killed_players' => $killed_players,
        ]);
    }

    //formulaire d'édition d'un championnat
    public function editMatchForm($id)
    {
        return view('matchEdit', ['id' => $id]);
    }


    //Update d'un match
    public function matchUpdate(CreateAndEditMatchRequest $request)
    {


        $match = Matchs::where('id', $request->request->get('id'))->first();
        dd($request);

        $match->title = $request->request->get('title');
//        $match->championship_id = $request->request->get('championship_id');

        $match->save();


        return redirect('/championships');
    }




    //suppression d'un match
    public function delete($id)
    {
        Matchs::where('id', $id)->delete();
        return redirect('/championships');
    }
}
