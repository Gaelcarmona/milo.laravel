<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchs;
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

        $match = Matchs::where('id', $id)->first();

        return view('/match', [
            'id' => $id,
            'match' => $match,
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
//        dd($match);

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
