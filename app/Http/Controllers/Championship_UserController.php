<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Kill;
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

        $user = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user->user()->get();

        $users = [];

        foreach ($associateUsers as $associateUser) {
            $user = User::where('id', $associateUser->id)->first();

            $championship = Championship::query()->where('id', $championship_id)->first();
            $userHasChampionship = $championship->users()
                ->where('id', $associateUser->id)
                ->first();
            // dump($userHasChampionship);
            if (!$userHasChampionship) {

                $users[] = $user;
            }
//            $championship = Championship::where('id', $id)->first();
//            $championshipUsers = $championship->users()->get();
            # code...
        }


        return view('/form-player-in-championship', [
            'associateUsers' => $associateUsers,
            'championship_id' => $championship_id,
            'championshipBread' => $championshipBread,
            'users' => $users,
        ]);

    }

    public function insert(CreateChampionshipUserRequest $request)
    {

        $championship = Championship::query()->where('id', $request->input('championship_id'))->first();

        $championship->users()->syncWithoutDetaching($request->input('user_id'));

        return redirect()->route('displayChampionshipProfile', ['id' => $championship->id]);


    }

    public function delete($user_id, $championship_id)
    {

        $matchs = Matchs::query()->where('championship_id', $championship_id)->get();
        $results = Result::query()
            ->whereIn('match_id', $matchs->pluck('id')->toArray())
            ->get();

        foreach ($results as $result) {
            $kills = $result->kills()->where('user_killed_id', $user_id);
            $result->score = $result->score - $kills->count();
            $result->save();
            $kills->delete();

            if ($result->user_id == $user_id) {
                $result->kills()->delete();
                $result->delete();
            }
        }
        $championship = Championship::where('id', $championship_id)->first();
        $championship->users()->detach($user_id);

        return redirect()->route('displayChampionshipProfile', ['id' => $championship_id]);
    }

}
