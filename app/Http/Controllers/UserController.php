<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertUserImageRequest;
use App\Models\Associate_User;
use App\Models\Championship;
use App\Models\Deck;
use App\Models\Image;
use App\Models\Kill;
use App\Models\Matchs;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Http\Requests\CreateAndEditUserRequest;
use \App\Http\Requests\CreateAndEditPlayerRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function accountUser($id)
    {
//        $id = Auth::id();
        $user = User::query()->where('id', $id)->first();
        return view('/account-user', [
            'id' => $id,
            'user' => $user,
        ]);

    }

    public function insert(CreateAndEditUserRequest $request)
    {

        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return view('/login');
    }

    public function insertImagePlayer(InsertUserImageRequest $request, $id)
    {
        User::where('id', $id)->update([

            'image_id' => $request->input('image_id')]);

        return redirect()->route('displayPlayerProfile', ['id' => $id]);
        return view('/players');
    }

    public function deleteUser($user_id)
    {

        //Sélectionner les joueurs associés
        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        foreach ($associateUsers as $player) {
            //Suppression des kills et des résultats
            $results = Result::query()->where('user_id', $player->id)->get();

            foreach ($results as $result) {
                Kill::where('result_id', $result->id)->delete();
                $result->delete();
            }

            //Suppression des morts et réduction des scores des tueurs
            $otherResults = Result::query()
                ->with([
                    'kills.result',
                ])
                ->where('user_id', '!=', $player->id)
                ->get();

            $deaths = $otherResults
                ->pluck('kills')->flatten()
                ->where('user_killed_id', $player->id);

            foreach ($deaths as $death) {

                //Réduction des scores des tueurs
                $resultsWhereDeathOfUser = $death->result()->first();
                $resultsWhereDeathOfUser->score -= 1;
                $resultsWhereDeathOfUser->save();

                //Suppression des morts
                DB::statement(DB::raw('delete from kills where user_killed_id = ' . $player->id));

            }

            //Supprimer la présence dans les championnats
            $championships = Championship::query()->get();
            foreach ($championships as $championship) {
                $championship->users()->detach($player->id);
            }

            //Supprimer les decks
            $decks = Deck::query()->where('user_id', $player->id)->get();
            foreach ($decks as $deck) {
                $deck->delete();
            }

            //Supprimer l'association à un créateur
            DB::statement(DB::raw('delete from associate_user where user_id = ' . $player->id));

            //Supprimer le joueur
            $user = User::query()->where('id', $player->id);
            $user->delete();
        }


        //Suppression des kills et des résultats
        $results = Result::query()->where('user_id', $user_id)->get();

        foreach ($results as $result) {
            Kill::where('result_id', $result->id)->delete();
            $result->delete();
        }

        //Suppression des morts et réduction des scores des tueurs
        $otherResults = Result::query()
            ->with([
                'kills.result',
            ])
            ->where('user_id', '!=', $user_id)
            ->get();

        $deaths = $otherResults
            ->pluck('kills')->flatten()
            ->where('user_killed_id', $user_id);

        foreach ($deaths as $death) {

            //Réduction des scores des tueurs
            $resultsWhereDeathOfUser = $death->result()->first();
            $resultsWhereDeathOfUser->score -= 1;
            $resultsWhereDeathOfUser->save();

            //Suppression des morts
            DB::statement(DB::raw('delete from kills where user_killed_id = ' . $user_id));

        }

        //Supprimer la présence dans les championnats
        $championships = Championship::query()->get();
        foreach ($championships as $championship) {
            $championship->users()->detach($user_id);
        }

        //Supprimer les matchs
        $userChampionships = Championship::query()->where('user_id', $user_id)->get();

        foreach ($userChampionships as $userChampionship)
        {
            Matchs::query()->where('championship_id', $userChampionship->id)->delete();
            $userChampionship->delete();
        }

        //Supprimer les decks
        $decks = Deck::query()->where('user_id', $user_id)->get();
        foreach ($decks as $deck) {
            $deck->delete();
        }

        //Supprimer l'association à un créateur
        DB::statement(DB::raw('delete from associate_user where user_id = ' . $user_id));

        //Supprimer le joueur
        $user = User::query()->where('id', $user_id);
        $user->delete();

        return redirect()->route('register');
    }

    public function delete($user_id)
    {
        //Suppression des kills et des résultats
        $results = Result::query()->where('user_id', $user_id)->get();

        foreach ($results as $result) {
            Kill::where('result_id', $result->id)->delete();
            $result->delete();
        }

        //Suppression des morts et réduction des scores des tueurs
        $otherResults = Result::query()
            ->with([
                'kills.result',
            ])
            ->where('user_id', '!=', $user_id)
            ->get();

        $deaths = $otherResults
            ->pluck('kills')->flatten()
            ->where('user_killed_id', $user_id);

        foreach ($deaths as $death) {

            //Réduction des scores des tueurs
            $resultsWhereDeathOfUser = $death->result()->first();
            $resultsWhereDeathOfUser->score -= 1;
            $resultsWhereDeathOfUser->save();

            //Suppression des morts
            DB::statement(DB::raw('delete from kills where user_killed_id = ' . $user_id));

        }

        //Supprimer la présence dans les championnats
        $championships = Championship::query()->get();
        foreach ($championships as $championship) {
            $championship->users()->detach($user_id);
        }

        //Supprimer les decks
        $decks = Deck::query()->where('user_id', $user_id)->get();
        foreach ($decks as $deck) {
            $deck->delete();
        }

        //Supprimer l'association à un créateur
        DB::statement(DB::raw('delete from associate_user where user_id = ' . $user_id));

        //Supprimer le joueur
        $user = User::query()->where('id', $user_id);
        $user->delete();

        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        return redirect()->route('players', ['associateUsers' => $associateUsers]);
    }


    public function playerInsert(CreateAndEditPlayerRequest $request)
    {
        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->save();
        $this->associateUserInsert($user);

        return redirect()->route('players', ['associateUsers' => $associateUsers]);
    }

    public function associateUserInsert(User $user)
    {
        $user->users()->syncWithoutDetaching(Auth::id());
    }

    //affichage des joueurs créés par l'user
    public function displayPlayers()
    {
        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        return view('/players', [
            'associateUsers' => $associateUsers,
            'user_creator' => $user_creator,
        ]);
    }

    //formulaire d'édition d'un player
    public function editPlayerForm($id)
    {
        $playerBread = User::query()->where('id', $id)->first();

        return view('playerEdit', [
            'id' => $id,
            'playerBread' => $playerBread,
        ]);
    }

    public function formUpdateUser($id)
    {
        $playerBread = User::query()->where('id', $id)->first();
        $user = User::query()->where('id', $id)->first();
        $images = Image::query()->get();


        return view('/user-edit', [
            'id' => $id,
            'playerBread' => $playerBread,
            'user' => $user,
            'images' => $images,
        ]);
    }

    public function userUpdate(CreateAndEditPlayerRequest $request)
    {
        $user = User::where('id', $request->request->get('id'))->first();
        $user->pseudo = $request->request->get('pseudo');
        $user->email = $request->request->get('email');
        $user->password = Hash::make($request->request->get('password'));
        $user->image_id = $request->request->get('image_id');

        $user->save();

        return redirect('/players');
    }


    public function playerUpdate(CreateAndEditPlayerRequest $request)
    {

        $user = User::where('id', $request->request->get('id'))->first();
        $user->pseudo = $request->request->get('pseudo');
        $user->save();

        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        return redirect()->route('players', ['associateUsers' => $associateUsers]);

    }


    public function displayPlayerProfile($player_id)
    {
        $decks = Deck::query()->where('user_id', '=', $player_id)->get();
        $player = User::query()
            ->with([
                'championships.matchs.results.user',
                'championships.matchs.results.kills.user',
                'championships.matchs.results.kills.result',
                'championships.users',
            ])
            ->where('id', $player_id)
            ->first();

        $user_creator = User::query()->where('id', '=', Auth::id())->first();
        $associateUsers = $user_creator->user()->get();

        $championships = $player->championships;

        $championshipsResults = $player->championships
            ->pluck('matchs')->flatten()
            ->pluck('results')->flatten();

        $results_for_player = $championshipsResults
            ->where('user_id', $player->id);

        $resultsOthersPlayers = $championshipsResults
            ->where('user_id', '!=', $player_id);

        //Total des fois ou un autre player a tué notre player, 2 versions
        $totalKillsByKiller = array_count_values($resultsOthersPlayers->pluck('kills')->flatten()
            ->where('user_killed_id', $player->id)
            ->pluck('result.user_id')
            ->toArray());

        //classement des players par nombre de kills
        $totalKills = $championshipsResults
            ->groupBy(function (Result $result) {
                return $result->user->id;
            })
            ->sortByDesc(function (Collection $collection) {
                return $collection->pluck('kills')->flatten()->count();
            })
            ->map(function (Collection $collection, $pseudo) {
                return $collection->pluck('kills')->flatten()->count();
            })
            ->toArray();

        $killRank = array_search($player_id, array_keys($totalKills)) + 1;

        $totalMatch = Matchs::query()
            ->get()->count();
        $images = Image::query()->get();

        $siteTitle = $player->pseudo;

        return view('/player', [
            'id' => $player_id,
            'killRank' => $killRank,
            'player' => $player,
            'decks' => $decks,
            'userChampionships' => $championships,
            'results_for_player' => $results_for_player,
            'associateUsers' => $associateUsers,
            'user_creator' => $user_creator,
            'results' => $resultsOthersPlayers,
            'totalKillsByKiller' => $totalKillsByKiller,
            'championshipsResults' => $championshipsResults,
            'images' => $images,
            'totalMatch' => $totalMatch,
            'siteTitle' => $siteTitle,
        ]);
    }

}



