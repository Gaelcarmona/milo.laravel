<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <div class="row">
            <nav aria-label="Breadcrumb" class="breadcrumb">
                <ul>
                    <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
                    <li><a href="{{ route('statistic.championships') }}">Les championnats</a></li>
                    <li><a href="{{ route('statistic.championship', $championship->id) }}">{{ $championship->title }}</a></li>
            
            {{--                        <li><a href="{{ route('statistic.playerInChampionship') }}">Les joueurs</a></li>--}}
                    <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                </ul>
            </nav>
            <div class="col-md-6 col-12  padding">

{{--                <img src="../../images/players.jpg" alt="">--}}
                <img src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}" alt="">

            </div>
            <div class="col-6">
                <div class="d-flex align-items-start">


                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            ELO
                            : {{ ($results_for_player->where('place', 1)->count('place') + $results_for_player->pluck('kills')->flatten()->count()) + ($results_for_player->where('place', 2)->count('place') / 2) + ($results_for_player->where('place', 3)->count('place') / 3) / round(($results_for_player->count('*') / $totalMatchInChampionship) * 100, 1)}}
                            <br>
{{--                            @dd($results_for_player->count('*'));--}}
                            Score moyen : {{round($results_for_player->avg('score'),2) }}<br>
                            Pourcentage de victoire : {{ round(($results_for_player->where('place', 1)->count('place') / $results_for_player->count('*')) * 100, 2) }}%<br>
                            Pourcentage de participation : {{ round(($results_for_player->count('*') / $totalMatchInChampionship) * 100, 2) }}%<br>
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
                                    <p>{{ $kills->first()->user->pseudo }} : {{  $kills->count() }} fois</p>
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
                                    <p>Par {{ $User->pseudo }}
                                        : {{ $totalKillsByKiller[$User->id] }}</p>
                                @endif
                            @endforeach
                        </div>

                    </div>

                </div>

            </div>
        </div>
</x-app-layout>
