<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <div class="row">
            <div class="col-6 padding">
                {{-- <figure> --}}
                <img src="../images/players.jpg" alt="">
                {{-- </figure> --}}

            </div>
            <div class="col-6">
                <nav aria-label="Breadcrumb" class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('user') }}">Accueil</a></li>
                        <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                        <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                    </ul>
                </nav>

                {{--                <p>{{ $player->pseudo }} participe aux championnats : {{ $averagePointsByMatchByChampionship }}</p>--}}
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">Statistiques générales
                        </button>
                        @foreach($userChampionships as $userChampionship)
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile"
                                    aria-selected="false">{{ $userChampionship->title }}</button>
                        @endforeach
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            ELO : {{ ($results_for_player->where('place', 1)->count('place') + $results_for_player->pluck('kills')->flatten()->count()) + ($results_for_player->where('place', 2)->count('place') / 2) + ($results_for_player->where('place', 3)->count('place') / 3) / $percentParticipation}}<br>
                            Score moyen : {{round($results_for_player->avg('score'),2) }}<br>
                            Pourcentage de victoire : {{ $percentWin }}%<br>
                            Pourcentage de participation : {{ $percentParticipation }}%<br>
                            Nombre de victoires : {{ $results_for_player->where('place', 1)->count('place') }}<br>
                            Nombre de parties jouées : {{ $results_for_player->count('*') }}<br>
                            2èmes places : {{ $results_for_player->where('place', 2)->count('place') }}<br>
                            3èmes places : {{ $results_for_player->where('place', 3)->count('place') }}<br>
                            4èmes places : {{ $results_for_player->where('place', 4)->count('place') }}<br>
                            5èmes places : {{ $results_for_player->where('place', 5)->count('place') }}<br>
                            6èmes places : {{ $results_for_player->where('place', 6)->count('place') }}<br>

                            Place moyenne : {{ round($results_for_player->avg('place'),2) }}<br>
                            Nombre total de points : {{ $results_for_player->sum('score') }}<br>

                            Nombre de kills par partie : {{ round($results_for_player->pluck('kills')->flatten()->count() / $results_for_player->count(),2) }} <br>
                            Nombre total de kills : {{ $results_for_player->pluck('kills')->flatten()->count() }}<br>

                            Classement kills :<br>

                            Cibles favorites :<br>

                            Joueur 3 :<br>
                            Joueur 5 :<br>
                            Joueur 2 :<br>
                            Joueur 6 :<br>
                            Joueur 4 :<br>

                            Meilleurs ennemis :<br>

                            Joueur 4 :<br>
                            Joueur 2 :<br>
                            Joueur 6 :<br>
                            Joueur 3 :<br>
                            Joueur 5 :<br>


                        </div>
                        @foreach($userChampionships as $userChampionship)
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                 aria-labelledby="v-pills-profile-tab">...
                            </div>
                        @endforeach
                        {{--    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>--}}
                        {{--    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>--}}
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
                            <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title }}</a></td>
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
