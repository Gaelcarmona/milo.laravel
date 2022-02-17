<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;
use \App\Http\Requests\CreateAndEditDeckRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeckController extends Controller
{
    public function deckForm(Request $request, $id)
    {
        $player = User::where('id', $id)->first();
        return view('/createDeck'
        , [
            'player' => $player]);
    }

    public function insert(CreateAndEditDeckRequest $request)
    {
        $deck = new Deck();
        $deck->title = $request->input('title');
        $deck->user_id = $request->input('user_id');
        $deck->save();

        return redirect()->route('displayPlayerProfile',['id' => $deck->user_id]);

    }
}
