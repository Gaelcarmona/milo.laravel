<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Championship_User;
use App\Models\Associate_User;
use Illuminate\Http\Request;
use \App\Http\Requests\CreateChampionshipUserRequest;

class Championship_UserController extends Controller
{
    public function formPlayerInChampionship($championship_id)
    {
        //fil d'ariane
        $championshipBread = Championship::query()->where('id', $championship_id)->first();

        $user = User::query()->where('id','=', Auth::id())->first();
        $associateUsers = $user->user()->get();


        return view('/form-player-in-championship', [
            'associateUsers' => $associateUsers,
            'championship_id' => $championship_id,
            'championshipBread' => $championshipBread,
        ]);

    }

    public function insert(CreateChampionshipUserRequest $request)
    {

        $championship = Championship::query()->where('id',$request->input('championship_id'))->first();

        $championship->users()->syncWithoutDetaching($request->input('user_id'));

        return redirect()->route('displayChampionshipProfile', ['id' => $championship->id]);


    }

    public function delete($user_id, $championship_id)
    {

        DB::beginTransaction();

        try {
            $matchs = Matchs::query()->where('championship_id', $championship_id)->get();
            $results = Result::query()->whereIn('match_id', $matchs->pluck('id')->toArray())->get();
            foreach ($results as $result)
            {
            $result->kills()->where('user_killed_id', $user_id)->delete();
            $result->where('user_id', $user_id)->delete();

            }
            Championship_User::where('user_id', $user_id)
                ->where('championship_id', $championship_id)
                ->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            dd("On est pas good", $e->getMessage());
        }
        DB::commit();


        dd(
            "On est good"

        );

        return redirect()->route('displayChampionshipProfile', ['id' => $championship_id]);
        return redirect('/championships');
    }

}
