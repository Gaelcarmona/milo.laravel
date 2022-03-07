<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="row">
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                <li><span aria-current="page">{{ $player->pseudo }}</span></li>
            </ul>
        </nav>
        <div class="col-md-6 col-12 padding">
            <img
                src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}"
                alt="">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-1 mt-1 bg-info" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                Modification de l'image du joueur
            </button>
            <!-- Modal -->
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sélectionne une image pour ce joueur
                            </h5>
                            <button type="button" class="btn-close bg-info" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('insert.image.player', ['id' => $player->id]) }}"
                                  class='mx-5 mt-5'
                                  method='post'>
                                @csrf
                                <div class="row">
                                    @foreach ($images as $image)
                                        <div class="col-4">
                                            <label>
                                                <input type="radio" name='image_id' required
                                                       value="{{ $image->id }}">
                                                <img src="{{ asset('images/small') }}/{{ $image->url }}">
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type='submit' class='btn btn-primary mb-1 mt-1 bg-info my-3'>Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex align-items-start">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                         aria-labelledby="v-pills-home-tab">
                        ELO :
                        @if($totalMatch != 0 && $results_for_player->count('*') != 0)
                            {{ $results_for_player->where('place', 1)->count('place') +$results_for_player->pluck('kills')->flatten()->count() +$results_for_player->where('place', 2)->count('place') / 2 +$results_for_player->where('place', 3)->count('place') /3 /round(($results_for_player->count('*') / $totalMatch) * 100, 1) }}
                        @endif
                        <br>
                        Score moyen : {{ round($results_for_player->avg('score'), 2) }}<br>
                        Pourcentage de victoire :
                        @if($results_for_player->count('*') != 0)
                        {{ round(($results_for_player->where('place', 1)->count('place') / $results_for_player->count('*')) * 100, 1) }}%
                        @endif
                        <br>
                        Pourcentage de participation :
                        @if($totalMatch != 0 && $results_for_player->count('*') != 0)
                        {{ round(($results_for_player->count('*') / $totalMatch) * 100, 1) }}%
                        @endif
                        <br>
                        Nombre de victoires : {{ $results_for_player->where('place', 1)->count('place') }}<br>
                        Nombre de parties jouées : {{ $results_for_player->count('*') }}<br>
                        2èmes places : {{ $results_for_player->where('place', 2)->count('place') }}<br>
                        3èmes places : {{ $results_for_player->where('place', 3)->count('place') }}<br>
                        4èmes places : {{ $results_for_player->where('place', 4)->count('place') }}<br>
                        5èmes places : {{ $results_for_player->where('place', 5)->count('place') }}<br>
                        6èmes places : {{ $results_for_player->where('place', 6)->count('place') }}<br>

                        Place moyenne : {{ round($results_for_player->avg('place'), 2) }}<br>
                        Nombre total de points : {{ $results_for_player->sum('score') }}<br>

                        Nombre de kills par partie :
                        @if($results_for_player->count() != 0)
                        {{ round($results_for_player->pluck('kills')->flatten()->count() / $results_for_player->count(),2) }}
                        @endif
                        <br>


                        Classement kills : {{ $killRank }}ème<br><br>
                        Nombre total de kills de {{ $player->pseudo }}
                        : {{ $results_for_player->pluck('kills')->flatten()->count() }}<br>

                        <br>
                        @foreach ($results_for_player->pluck('kills')->flatten()->groupBy('user_killed_id') as $enemy_id => $kills)
                            @if ($enemy_id != $player->id)
                                <p>{{ $kills->first()->user->pseudo }} : {{ $kills->count() }} fois</p>
                            @endif
                        @endforeach
                        <br>
                        taux de mortalité :
                        @if($results_for_player->count('*') != 0)
                        {{ round(($results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() /$results_for_player->count('*')) *100,2) }}%
                        @endif
                        <br>
                        Nombre total de morts
                        : {{ $results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() }} <br>
                        @if ($user_creator->id != $player->id && isset($totalKillsByKiller[$user_creator->id]))
                            <p>{{ $user_creator->pseudo }} : {{ $totalKillsByKiller[$user_creator->id] }}</p>
                        @endif
                        @foreach ($associateUsers as $associateUser)
                            @if ($associateUser->id != $player->id && isset($totalKillsByKiller[$associateUser->id]))
                                <p>Par {{ $associateUser->pseudo }}
                                    : {{ $totalKillsByKiller[$associateUser->id] }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <h1>Les decks de {{ $player->pseudo }}</h1>
            <table class='col-12 bg-main'>
                <thead class='text-white bg-dark'>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                </thead>
                <tbody>
                @foreach ($decks as $deck)
                    <tr>
                        <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title }}</a>
                        </td>
                        <td><a href="{{ route('editForm.deck', $deck->id) }}"> modifier</a></td>
                        <td><a href="{{ route('delete.deck', $deck->id) }}"
                               onclick="
                            var result = alert('Vous ne pouvez pas supprimer ce deck alors que des résultats lui sont associés');return false">supprimer</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary mb-1 mt-1 bg-info mb-1" href="{{ route('form.deck', ['id' => $player->id]) }}">Créer
                un deck</a>
        </div>
    </div>
</x-app-layout>
