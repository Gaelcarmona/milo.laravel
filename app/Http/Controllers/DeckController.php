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

        return redirect()->route('displayPlayerProfile', ['id' => $deck->user_id]);

    }

    public function displayDeckProfile($id)
    {

        $deck = Deck::where('id', $id)->first();

        return view('/deck', [
            'id' => $id,
            'deck' => $deck,
        ]);
    }

    //formulaire d'édition d'un championnat
    public function editDeckForm($id)
    {
        return view('deckEdit', ['id' => $id]);
    }

    //Update d'un deck
    public function deckUpdate(CreateAndEditDeckRequest $request)
    {

        $deck = Deck::where('id', $request->request->get('id'))->first();
        $deck->title = $request->request->get('title');
        $deck->save();

        return redirect()->route('displayPlayerProfile', ['id' => $deck->user_id]);
//        return redirect('/players');
    }

    public function delete($id)
    {
        $deck = Deck::query()->where('id', $id)->first();

        Deck::where('id', $id)->delete();

        return redirect()->route('displayPlayerProfile', ['id' => $deck->user_id]);
    }

    public function decksUser(User $user)
    {

//        dd($user);

        $decksUser = Deck::query()->where('user_id', '=', $user->id)->get();
//        $decks[] = $decksUser;
        return response()->json($decksUser);
    }
}
