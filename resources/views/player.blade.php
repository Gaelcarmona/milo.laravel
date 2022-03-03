<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <div class="row">
            <div class="col-6 padding">
                {{-- <figure> --}}
                    {{-- {$img = player->image->url ? player->image->url :'player.jpg';} --}}
                {{-- @if (isset($player->image->url))
                    <img src="{{ asset('images/large') }}/{{ $player->image->url }}" alt="">
                    @else
                    <img src="../images/large/players.jpg" alt="">
                    @endif --}}
                    {{-- {{ player->image->url ?player->image->url  : 'player.jpg' }} --}}
                    <img src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}" alt="">
                {{-- </figure> --}}


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('insert.image.player', ['id' => $player->id]) }}" class='mx-5 mt-5'
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
                                    <button type='submit' class='btn btn-primary my-3'>Envoyer</button>
                                </form>
                            </div>
                            {{-- <div class="modal-footer"> --}}
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <nav aria-label="Breadcrumb" class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('user') }}">Accueil</a></li>
                        <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                        <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                    </ul>
                </nav>
                <div class="d-flex align-items-start">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            ELO
                            :
                            {{ $results_for_player->where('place', 1)->count('place') +$results_for_player->pluck('kills')->flatten()->count() +$results_for_player->where('place', 2)->count('place') / 2 +$results_for_player->where('place', 3)->count('place') /3 /round(($results_for_player->count('*') / $totalMatch) * 100, 1) }}
                            <br>
                            Score moyen : {{ round($results_for_player->avg('score'), 2) }}<br>
                            Pourcentage de victoire
                            :
                            {{ round(($results_for_player->where('place', 1)->count('place') / $results_for_player->count('*')) * 100, 1) }}
                            %<br>
                            Pourcentage de participation
                            : {{ round(($results_for_player->count('*') / $totalMatch) * 100, 1) }}%<br>
                            Nombre de victoires : {{ $results_for_player->where('place', 1)->count('place') }}<br>
                            Nombre de parties jouées : {{ $results_for_player->count('*') }}<br>
                            2èmes places : {{ $results_for_player->where('place', 2)->count('place') }}<br>
                            3èmes places : {{ $results_for_player->where('place', 3)->count('place') }}<br>
                            4èmes places : {{ $results_for_player->where('place', 4)->count('place') }}<br>
                            5èmes places : {{ $results_for_player->where('place', 5)->count('place') }}<br>
                            6èmes places : {{ $results_for_player->where('place', 6)->count('place') }}<br>

                            Place moyenne : {{ round($results_for_player->avg('place'), 2) }}<br>
                            Nombre total de points : {{ $results_for_player->sum('score') }}<br>

                            Nombre de kills par partie
                            :
                            {{ round($results_for_player->pluck('kills')->flatten()->count() / $results_for_player->count(),2) }}
                            <br>


                            Classement kills : {{ $killRank }}ème<br><br>
                            Nombre total de kills de {{ $player->pseudo }}
                            : {{ $results_for_player->pluck('kills')->flatten()->count() }}<br>
                            @if ($user_creator->id != $player->id)
                                <p>Total des kills de {{ $user_creator->pseudo }}
                                    :
                                    {{ $championshipsResults->where('user_id', $user_creator->id)->pluck('kills')->flatten()->groupBy('result_id')->flatten()->count() }}
                                </p>
                            @endif
                            @foreach ($associateUsers as $associateUser)
                                @if ($associateUser->id != $player->id)
                                    <p>Total des kills de {{ $associateUser->pseudo }}
                                        :
                                        {{ $championshipsResults->where('user_id', $associateUser->id)->pluck('kills')->flatten()->groupBy('result_id')->flatten()->count() }}
                                    </p>
                                @endif
                            @endforeach
                            <br>
                            @foreach ($results_for_player->pluck('kills')->flatten()->groupBy('user_killed_id')
    as $enemy_id => $kills)
                                @if ($enemy_id != $player->id)
                                    <p>{{ $kills->first()->user->pseudo }} : {{ $kills->count() }}</p>
                                @endif
                            @endforeach
                            <br>
                            taux de mort par partie
                            :
                            {{ round(($results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() /$results_for_player->count('*')) *100,2) }}
                            %<br>
                            Nombre total de morts
                            : {{ $results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() }} <br>
                            @if ($user_creator->id != $player->id && isset($totalKillsByKiller[$user_creator->id]))
                                <p>{{ $user_creator->pseudo }} : {{ $totalKillsByKiller[$user_creator->id] }}</p>
                            @endif
                            @foreach ($associateUsers as $associateUser)
                                @if ($associateUser->id != $player->id && isset($totalKillsByKiller[$associateUser->id]))
                                    <p>Nombre de fois tué par {{ $associateUser->pseudo }}
                                        : {{ $totalKillsByKiller[$associateUser->id] }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <h1>Les decks de {{ $player->pseudo }}</h1>
                <table class='col-12 bg-main'>
                    <thead class='text-white bg-dark'>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody>
                        @foreach ($decks as $deck)
                            <tr>
                                <td>{{ $deck->id }}</td>
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
                <a href="{{ route('form.deck', ['id' => $player->id]) }}">Créer un deck</a>
            </div>
        </div>
    </main>
</x-app-layout>
