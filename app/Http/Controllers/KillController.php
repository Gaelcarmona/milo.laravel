<?php

namespace App\Http\Controllers;

use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class KillController extends Controller
{
    //vers le formulaire de création de match par un user
    public function killForm($match_id)
    {
//        $users = User::where('id',)->get();
        $match = Matchs::where('id', $match_id)->first();
//       $users = Matchs::find($match)->user()->get();

        dd($match);
//        dd($results[0]->user_id);

//        $result = Result::where('id', $id)->first();
        return view('/create-kill'
            , [
                'result' => $result]);
    }
}
