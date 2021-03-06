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
    public function displayMatchProfile($match_id)
    {
        $results = Result::query()->where('match_id', '=', $match_id)->get();

        $match = Matchs::where('id', $match_id)->first();

        $ids = [];
        foreach ($results as $result) {
            $ids[] = $result->id;
        }

        $killed_players = Kill::whereIn('result_id', $ids)->get();
//        dd($killed_players);

        return view('/match', [
            'id' => $match_id,
            'match' => $match,
            'results' => $results,
            'killed_players' => $killed_players,
        ]);
    }

    //formulaire d'édition d'un championnat
    public function editMatchForm($id)
    {
        $matchBread = Matchs::query()->where('id', $id)->first();

        return view('matchEdit', [
            'id' => $id,
            'matchBread' => $matchBread,
        ]);
    }


    //Update d'un match
    public function matchUpdate(CreateAndEditMatchRequest $request)
    {


        $match = Matchs::where('id', $request->request->get('id'))->first();
//        dd($request);

        $match->title = $request->request->get('title');
//        $match->championship_id = $request->request->get('championship_id');

        $match->save();


        return redirect()->route('displayChampionshipProfile', ['id' => $match->championship_id]);
    }


    //suppression d'un match
    public function delete($id)
    {
        $match = Matchs::query()->where('id', $id)->first();

        // récupération des résultats en vue de les delete avant le match
        $results = Result::query()->where('match_id', $id)->get();

        foreach ($results as $result) {

            //suppression des kills de chaque résultat
            Kill::where('result_id', $result->id)->delete();

            //suppression de chaque résultat du match
            Result::where('id', $result->id)->delete();
        }

        Matchs::where('id', $id)->delete();

        return redirect()->route('displayChampionshipProfile', ['id' => $match->championship_id]);
    }
}
