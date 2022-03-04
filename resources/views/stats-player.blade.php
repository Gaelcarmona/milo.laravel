<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <div class="row">
            <div class="col-6 padding">
                {{-- <figure> --}}
{{--                <img src="../images/players.jpg" alt="">--}}
                <img src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}" alt="">
                {{-- </figure> --}}

            </div>
            <div class="col-6">
                <nav aria-label="Breadcrumb" class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
                        <li><a href="{{ route('statistic.players') }}">Les joueurs</a></li>
                        <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                    </ul>
                </nav>
                <div class="d-flex align-items-start">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div>
                            ELO
                            : {{ ($results_for_player->where('place', 1)->count('place') + $results_for_player->pluck('kills')->flatten()->count()) + ($results_for_player->where('place', 2)->count('place') / 2) + ($results_for_player->where('place', 3)->count('place') / 3) / round(($results_for_player->count('*') / $totalMatch) * 100, 1)}}
                            <br>
                            Score moyen : {{round($results_for_player->avg('score'),2) }}<br>
                            Pourcentage de victoire : {{ round(($results_for_player->where('place', 1)->count('place') / $results_for_player->count('*')) * 100, 2) }}%<br>
                            Pourcentage de participation : {{ round(($results_for_player->count('*') / $totalMatch) * 100, 2) }}%<br>
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
                            @foreach($Users as $User)
                                @if($User->id != $player->id && isset($totalKillsByKiller[$User->id]))
                                    <p>Nombre de fois tué par {{ $User->pseudo }}
                                        : {{ $totalKillsByKiller[$User->id] }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <h1>Les decks de {{ $player->pseudo }}</h1>
                <table class='col-12 bg-main'>
                    <thead class='text-white bg-dark'>
                    <th>Nom</th>
                    </thead>
                    <tbody>
                    @foreach ($decks as $deck)
                        <tr>
                            <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </main>
</x-app-layout>
