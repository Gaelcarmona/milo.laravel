<?php

namespace App\Http\Controllers;

use App\Models\Kill;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use \App\Http\Requests\CreateAndEditKillRequest;

class KillController extends Controller
{
    //vers le formulaire de création de match par un user
    public function killForm($result_id, $match_id)
    {
        $resultMatchUsers = Result::query()->where('match_id', $match_id)
            ->where('id', '!=', $result_id)
            ->get();

        return view('/create-kill'
            , [
                'match_id' => $match_id,
                'result_id' => $result_id,
                'resultMatchUsers' => $resultMatchUsers,
            ]);
    }

    //Insertion d'un résultat pour un joueur
    public function insert(CreateAndEditKillRequest $request)
    {
        $kill = new Kill();

        $kill->result_id = $request->input('result_id');
        $kill->user_killed_id = $request->input('user_killed_id');

        $kill->save();

        return redirect()->route('championships');

    }

    //suppression d'un kill
    public function delete($result_id, $user_killed_id)
    {
        Kill::where('result_id', $result_id)
            ->where('user_killed_id', $user_killed_id )
            ->delete();
        return redirect('/championships');
    }
}
