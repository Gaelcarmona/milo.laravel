<?php

namespace App\Http\Controllers;

use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class KillController extends Controller
{
    //vers le formulaire de création de match par un user
    public function killForm($result_id, $match_id)
    {
        $resultMatchUsers = Result::where('match_id', $match_id)->get();

        return view('/create-kill'
            , [
                'match_id' => $match_id,
                'result_id' => $result_id,
                'resultMatchUsers' => $resultMatchUsers,
            ]);
    }
}
