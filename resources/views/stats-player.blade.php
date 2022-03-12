@section('title', 'Statistiques de '. $player->pseudo)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="row">
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
                <li><a href="{{ route('statistic.players') }}">Les joueurs</a></li>
                <li><span aria-current="page">{{ $player->pseudo }}</span></li>
            </ul>
        </nav>
        <div class="col-md-6 col-12 padding">
            <img
                src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}"
                alt="">
        </div>
        <div class="col-6">
            <div class="d-flex align-items-start">
                <div class="tab-content" id="v-pills-tabContent">
                    <div>
                        ELO :
                        {{--                            @dd($results_for_player);--}}
                        @if($totalMatch != 0 && $results_for_player->count('*') != 0)
                            {{ ($results_for_player->where('place', 1)->count('place') + $results_for_player->pluck('kills')->flatten()->count()) + ($results_for_player->where('place', 2)->count('place') / 2) + ($results_for_player->where('place', 3)->count('place') / 3) / round(($results_for_player->count('*') / $totalMatch) * 100, 1)}}
                        @endif
                        <br>
                        Score moyen : {{round($results_for_player->avg('score'),2) }}<br>
                        Pourcentage de victoire :
                        @if($results_for_player->count('*') != 0)
                            {{ round(($results_for_player->where('place', 1)->count('place') / $results_for_player->count('*')) * 100, 2) }}
                            %<br>
                        @endif
                        Pourcentage de participation :
                        @if($totalMatch != 0 && $results_for_player->count('*') != 0)
                        {{ round(($results_for_player->count('*') / $totalMatch) * 100, 2) }}%
                        @endif
                        <br>
                        Nombre de victoires : {{ $results_for_player->where('place', 1)->count('place') }}<br>
                        Nombre de parties jouées : {{ $results_for_player->count('*') }}<br>
                        2èmes places : {{ $results_for_player->where('place', 2)->count('place') }}<br>
                        3èmes places : {{ $results_for_player->where('place', 3)->count('place') }}<br>
                        4èmes places : {{ $results_for_player->where('place', 4)->count('place') }}<br>
                        5èmes places : {{ $results_for_player->where('place', 5)->count('place') }}<br>
                        6èmes places : {{ $results_for_player->where('place', 6)->count('place') }}<br>

                        Place moyenne : {{ round($results_for_player->avg('place'),2) }}<br>
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
                        @foreach($results_for_player->pluck('kills')->flatten()->groupBy('user_killed_id') as $enemy_id => $kills)
                            @if($enemy_id != $player->id)
                                <p>{{ $kills->first()->user->pseudo }} : {{  $kills->count() }} fois</p>
                            @endif
                        @endforeach
                        <br>
                        taux de mortalité :
                        @if($results_for_player->count('*') != 0)
                        {{ round($results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() / $results_for_player->count('*') * 100, 2) }}%
                        @endif
                        <br>
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
{{--            <h1>Les decks de {{ $player->pseudo }}</h1>--}}
{{--            <table class='col-12 bg-main table'>--}}
{{--                <thead class='text-white bg-dark'>--}}
{{--                <th>Nom</th>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach ($decks as $deck)--}}
{{--                    <tr>--}}
{{--                        <td><a href="{{ route('statistic.deck', $deck->id) }}">{{ $deck->title }}</a></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
        </div>
                <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                        aria-controls="flush-collapseThree">
                    Les decks
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                 data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <table class='col-12 bg-main table'>
                        <thead class='text-white bg-dark'>
                        <th>Nom</th>
                        </thead>
                        <tbody>
                        @foreach ($decks as $deck)
                            <tr>
                                <td><a href="{{ route('statistic.deck', $deck->id) }}">{{ $deck->title }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary mb-1 mt-1 bg-info mb-1"
                       href="{{ route('form.deck', ['id' => $player->id]) }}">Créer
                        un deck</a>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
