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
    //vers le formulaire de création de kill par un user
    public function killForm($result_id, $match_id)
    {
        $resultMatchUsers = Result::query()->where('match_id', $match_id)
            ->where('id', '!=', $result_id)
            ->get();

        $resultBread = Result::query()->where('match_id', $match_id)
            ->where('id', '!=', $result_id)
            ->first();

        $result = Result::query()->where('id', $result_id)->first();

        $killer = User::query()->where('id', $result->user_id)->first();

        //        dd($resultBread->match->title);
        return view(
            '/create-kill',
            [
                'match_id' => $match_id,
                'result_id' => $result_id,
                'resultMatchUsers' => $resultMatchUsers,
                'resultBread' => $resultBread,
                'killer' => $killer,
            ]
        );
    }

    //Insertion d'un kill pour un joueur
    public function insert(CreateAndEditKillRequest $request)
    {
        $kill = new Kill();

        $kill->result_id = $request->input('result_id');
        $kill->user_killed_id = $request->input('user_killed_id');

        $result = Result::query()->where('id', $kill->result_id)->first();

        $kill->save();
        $this->addScore($kill->result_id);

        return redirect()->route('displayMatchProfile', ['id' => $result->match_id]);
    }

    //suppression d'un kill
    public function delete($result_id, $user_killed_id)
    {
        Kill::where('result_id', $result_id)
            ->where('user_killed_id', $user_killed_id)
            ->delete();
        $this->reduceScore($result_id);

        $result = Result::query()->where('id', $result_id)->first();

        return redirect()->route('displayMatchProfile', ['id' => $result->match_id]);
    }

    public function addScore($id)
    {
        $result = Result::where('id', $id)->first();
        $result->score += 1;
        $result->save();
    }

    public function reduceScore($id)
    {
        $result = Result::where('id', $id)->first();
        $result->score -= 1;
        $result->save();
    }
}
