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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Launch static backdrop modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>


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
                            ELO
                            : {{ ($results_for_player->where('place', 1)->count('place') + $results_for_player->pluck('kills')->flatten()->count()) + ($results_for_player->where('place', 2)->count('place') / 2) + ($results_for_player->where('place', 3)->count('place') / 3) / $percentParticipation}}
                            <br>
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

                            Nombre de kills par partie
                            : {{ round($results_for_player->pluck('kills')->flatten()->count() / $results_for_player->count(),2) }}
                            <br>


                            Classement kills : {{ $killRank }}ème<br><br>
                            Nombre total de kills de {{ $player->pseudo }}
                            : {{ $results_for_player->pluck('kills')->flatten()->count() }}<br>
                            @if($user_creator->id != $player->id)
                                <p>Total des kills de {{ $user_creator->pseudo }}
                                    : {{ $championshipsResults->where('user_id',$user_creator->id )->pluck('kills')->flatten()->groupBy('result_id')->flatten()->count() }}</p>
                            @endif
                            @foreach($associateUsers as $associateUser)
                                @if($associateUser->id != $player->id)
                                    <p>Total des kills de {{ $associateUser->pseudo }}
                                        : {{ $championshipsResults->where('user_id',$associateUser->id )->pluck('kills')->flatten()->groupBy('result_id')->flatten()->count() }}</p>
                                @endif
                            @endforeach
                            <br>
                            @foreach($results_for_player->pluck('kills')->flatten()->groupBy('user_killed_id') as $enemy_id => $kills)
                                @if($enemy_id != $player->id)
                                    <p>{{ $kills->first()->user->pseudo }} : {{  $kills->count() }}</p>
                                @endif
                            @endforeach
                            <br>
                            taux de mort par partie
                            : {{ round($results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() / $results_for_player->count('*') * 100, 2) }}
                            %<br>
                            Nombre total de morts
                            : {{ $results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() }} <br>
                            @if($user_creator->id != $player->id && isset($totalKillsByKiller[$user_creator->id]))
                                <p>{{ $user_creator->pseudo  }} : {{ $totalKillsByKiller[$user_creator->id] }}</p>
                            @endif
                            @foreach($associateUsers as $associateUser)
                                @if($associateUser->id != $player->id && isset($totalKillsByKiller[$associateUser->id]))
                                    <p>Nombre de fois tué par {{ $associateUser->pseudo }} : {{ $totalKillsByKiller[$associateUser->id] }}</p>
                                @endif
                            @endforeach
                        </div>
                        @foreach($userChampionships as $userChampionship)
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                 aria-labelledby="v-pills-profile-tab">ELO
                                : {{ ($results_for_player->where('place', 1)->count('place') + $results_for_player->pluck('kills')->flatten()->count()) + ($results_for_player->where('place', 2)->count('place') / 2) + ($results_for_player->where('place', 3)->count('place') / 3) / $percentParticipation}}
                                <br>
                                Score moyen : {{round($results_for_player_in_championship->avg('score'),2) }}<br>
                                Pourcentage de victoire : {{ $percentWin }}%<br>
                                Pourcentage de participation : {{ $percentParticipation }}%<br>
                                Nombre de victoires
                                : {{ $results_for_player_in_championship->where('place', 1)->count('place') }}<br>
                                Nombre de parties jouées : {{ $results_for_player_in_championship->count('*') }}<br>
                                2èmes places
                                : {{ $results_for_player_in_championship->where('place', 2)->count('place') }}<br>
                                3èmes places
                                : {{ $results_for_player_in_championship->where('place', 3)->count('place') }}<br>
                                4èmes places
                                : {{ $results_for_player_in_championship->where('place', 4)->count('place') }}<br>
                                5èmes places
                                : {{ $results_for_player_in_championship->where('place', 5)->count('place') }}<br>
                                6èmes places
                                : {{ $results_for_player_in_championship->where('place', 6)->count('place') }}<br>

                                Place moyenne : {{ round($results_for_player_in_championship->avg('place'),2) }}<br>
                                Nombre total de points : {{ $results_for_player_in_championship->sum('score') }}<br>

                                Nombre de kills par partie
                                : {{ round($results_for_player_in_championship->pluck('kills')->flatten()->count() / $results_for_player_in_championship->count(),2) }}
                                <br>


                                Classement kills : {{ $killRankByChampionship }}ème<br><br>
                                Nombre total de kills de {{ $player->pseudo }}
                                : {{ $results_for_player_in_championship->pluck('kills')->flatten()->count() }}<br>
                                @if($user_creator->id != $player->id)
                                    <p>Total des kills de {{ $user_creator->pseudo }}
                                        : {{ $championshipResults->where('user_id',$user_creator->id )->pluck('kills')->flatten()->groupBy('result_id')->flatten()->count() }}</p>
                                @endif
                                @foreach($associateUsers as $associateUser)
                                    @if($associateUser->id != $player->id)
                                        <p>Total des kills de {{ $associateUser->pseudo }}
                                            : {{ $championshipResults->where('user_id',$associateUser->id )->pluck('kills')->flatten()->groupBy('result_id')->flatten()->count() }}</p>
                                    @endif
                                @endforeach
                                <br>
                                @foreach($results_for_player_in_championship->pluck('kills')->flatten()->groupBy('user_killed_id') as $enemy_id => $kills)
                                    @if($enemy_id != $player->id)
                                        <p>{{ $kills->first()->user->pseudo }} : {{  $kills->count() }}</p>
                                    @endif
                                @endforeach
                                <br>
                                taux de mort par partie
                                : {{ round($resultsOthersPlayersInChampionship->pluck('kills')->flatten()->where('user_killed_id', $id)->count() / $results_for_player_in_championship->count('*') * 100, 2) }}
                                %<br>
                                Nombre total de morts
                                : {{ $resultsOthersPlayersInChampionship->pluck('kills')->flatten()->where('user_killed_id', $id)->count() }} <br>
{{--                                @if($user_creator->id != $player->id && isset($totalKillsByKiller[$user_creator->id]))--}}
{{--                                    <p>{{ $user_creator->pseudo  }} : {{ $totalKillsByKiller[$user_creator->id] }}</p>--}}
{{--                                @endif--}}
                                @foreach($championshipUsers as $championshipUser)
                                    @if($championshipUser->id != $player->id && isset($totalKillsByKillerInChampionship[$championshipUser->id]))
                                        <p>Nombre de fois tué par {{ $championshipUser->pseudo }}
                                            : {{ $totalKillsByKillerInChampionship[$championshipUser->id] }}</p>
{{--                                        @dd($totalKillsByKillerInChampionship[$championshipUser->id])--}}

                                    @endif
                                @endforeach
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
