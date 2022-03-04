<?php

namespace App\Http\Controllers;

use App\Models\Associate_User;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Championship;
use App\Models\Matchs;
use App\Models\Championship_User;
use \App\Http\Requests\CreateAndEditChampionshipRequest;


class ChampionshipController extends Controller
{
    public string|int $user_id;

    public function isAuth()
    {
        $user_id = Auth::id();
        if ($user_id === null)
            return redirect("/login");
        $this->user_id = $user_id;
    }

    public function championshipForm()
    {
        $user = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user->user()->get();

        return view('/createchampionship', ['associateUsers' => $associateUsers]);
    }


    public function insert(CreateAndEditChampionshipRequest $request)
    {
        $championship = new Championship();

        $championship->title = $request->input('title');
        $championship->user_id = Auth::id();
        $championship->save();

        $this->championshipUserInsert($request, $championship);

        return redirect()->route('displayChampionshipProfile', ['id' => $championship->id]);
    }

    public function championshipUserInsert(Request $request, Championship $championship)
    {
        $championship->users()->sync($request->input('player'));
    }

    //affichage des championnats créés par l'user
    public function displayChampionships()
    {
        $championships = Championship::query()->where('user_id', '=', Auth::id())->get();

        return view('/championships', ['championships' => $championships]);
    }

    //affichage d'un championnat
    public function displayChampionshipProfile($id)
    {
        $matchs = Matchs::query()->where('championship_id', '=', $id)->get();

        $championship = Championship::where('id', $id)->first();
        $championshipUsers = $championship->users()->get();

        return view('/championship', [
            'id' => $id,
            'championship' => $championship,
            'matchs' => $matchs,
            'championshipUsers' => $championshipUsers,
        ]);
    }

    //formulaire d'édition d'un championnat
    public function editChampionshipForm($id)
    {
        $images = Image::query()->get();

        return view('championshipEdit', [
            'id' => $id,
            'images' => $images,
            ]);
    }

    //Update d'un championnat
    public function championshipUpdate(CreateAndEditChampionshipRequest $request)
    {
        $this->isAuth();

        $championship = Championship::where([
            'id' => $request->request->get('id'),
            'user_id' => $this->user_id

        ])->first();

        if ($championship === null)
            return redirect('/user?not_exists');

        $championship->title = $request->request->get('title');
         $championship->image_id = $request->request->get('image_id');
        $championship->save();

        return redirect('/championships');
//        return redirect()->route('displayChampionshipProfile', ['id' => $championship->id]);
    }

    public function delete($id)
    {
        Championship::where('id', $id)->delete();
        return redirect('/championships');
    }


}
