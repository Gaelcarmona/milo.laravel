@section('title', 'Statistiques de ' . $deck->title . ' dans ' . $championship->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="row">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Statistiques</a></li>
                <li class="breadcrumb-item"><a href="{{ route('statistic.championships') }}">Les championnats</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('statistic.championship', $championship->id) }}">{{ $championship->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $deck->title }}</li>
            </ol>
        </nav>
        <div class="col-md-6 col-12 padding">
            <img src="{{ asset('images/large') }}/{{ isset($deck->image->url) ? $deck->image->url : 'players.jpg' }}"
                alt="">
        </div>
        <div class="col-6">
            <div class="d-flex align-items-start">
                <div class="tab-content" id="v-pills-tabContent">
                    <div>
                        ELO :
                        @if ($totalMatchInChampionship != 0 && $results_for_deck->count('*') != 0)
                            {{ $results_for_deck->where('place', 1)->count('place') +$results_for_deck->pluck('kills')->flatten()->count() +$results_for_deck->where('place', 2)->count('place') / 2 +$results_for_deck->where('place', 3)->count('place') /3 /round(($results_for_deck->count('*') / $totalMatchInChampionship) * 100, 1) }}
                        @endif
                        <br>
                        Score moyen : {{ round($results_for_deck->avg('score'), 2) }}<br>
                        Pourcentage de victoire :
                        @if ($results_for_deck->count('*') != 0)
                            {{ round(($results_for_deck->where('place', 1)->count('place') / $results_for_deck->count('*')) * 100, 2) }}
                            %<br>
                        @endif
                        Pourcentage de participation :
                        @if ($totalMatchInChampionship != 0 && $results_for_deck->count('*') != 0)
                            {{ round(($results_for_deck->count('*') / $totalMatchInChampionship) * 100, 2) }}%
                        @endif
                        <br>
                        Nombre de victoires : {{ $results_for_deck->where('place', 1)->count('place') }}<br>
                        Nombre de parties jouées : {{ $results_for_deck->count('*') }}<br>
                        2èmes places : {{ $results_for_deck->where('place', 2)->count('place') }}<br>
                        3èmes places : {{ $results_for_deck->where('place', 3)->count('place') }}<br>
                        4èmes places : {{ $results_for_deck->where('place', 4)->count('place') }}<br>
                        5èmes places : {{ $results_for_deck->where('place', 5)->count('place') }}<br>
                        6èmes places : {{ $results_for_deck->where('place', 6)->count('place') }}<br>

                        Place moyenne : {{ round($results_for_deck->avg('place'), 2) }}<br>
                        Nombre total de points : {{ $results_for_deck->sum('score') }}<br>

                        Nombre de kills par partie :
                        @if ($results_for_deck->count() != 0)
                            {{ round($results_for_deck->pluck('kills')->flatten()->count() / $results_for_deck->count(),2) }}
                        @endif
                        <br>
                        Nombre total de kills de {{ $deck->title }}
                        : {{ $results_for_deck->pluck('kills')->flatten()->count() }}<br>
                        {{-- <br>
                        <br>
                        taux de mortalité :
                        @if ($results_for_deck->count('*') != 0)
                            {{ round(($resultsOthersDecks->pluck('kills')->flatten()->where('user_killed_id', $deck->user->id)->count() /$results_for_deck->count('*')) *100,2) }}
                            %
                        @endif
                        <br>
                        Nombre total de morts
                        :
                        {{ $resultsOthersDecks->pluck('kills')->flatten()->where('user_killed_id', $deck->user->id)->count() }}
                        <br> --}}

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
