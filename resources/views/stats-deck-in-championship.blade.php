@section('title', 'Statistiques de ' . $deck->title . ' dans ' . $championship->title)
@section('description', 'Ici on retrouve les statistiques de ' . $deck->title . ' dans ' . $championship->title)
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
        <div class="col-md-6 col-12">
            <img src="{{ asset('images/large') }}/{{ isset($deck->image->url) ? $deck->image->url : 'players.jpg' }}"
                alt="Image du deck">
        </div>
        <div class="col-md-6 col-12">
            <div id="statsDeck">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de points
                        <span class="badge bg-primary rounded-pill">
                            @if ($totalMatchInChampionship != 0 && $results_for_deck->count('*') != 0)
                                {{ $results_for_deck->sum('score') }}
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ELO
                        <span class="badge bg-primary rounded-pill">
                            @if ($totalMatchInChampionship != 0 && $results_for_deck->count('*') != 0)
                                {{ round(
                                    $results_for_deck->where('place', 1)->count('place') +
                                        $results_for_deck->pluck('kills')->flatten()->count() +
                                        $results_for_deck->where('place', 2)->count('place') / 2 +
                                        $results_for_deck->where('place', 3)->count('place') /
                                            3 /
                                            round(($results_for_deck->count('*') / $totalMatchInChampionship) * 100, 1),
                                    2,
                                ) }}
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Score moyen
                        <span
                            class="badge bg-primary rounded-pill">{{ round($results_for_deck->avg('score'), 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Place moyenne
                        <span
                            class="badge bg-primary rounded-pill">{{ round($results_for_deck->avg('place'), 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Éliminations par partie
                        <span class="badge bg-dark rounded-pill">
                            @if ($results_for_deck->count() != 0)
                                {{ round($results_for_deck->pluck('kills')->flatten()->count() / $results_for_deck->count(),2) }}
                            @endif
                        </span>
                    </li>
                    <div class="accordion" id="accordion1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseThree">
                                    Éliminations
                                    <span class="badge bg-dark rounded-pill ms-5 alignStatsOnAccordion">
                                        @if ($results_for_deck->count() != 0)
                                            {{ $results_for_deck->pluck('kills')->flatten()->count() }}
                                        @endif
                                    </span>
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordion1">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        @php $alreadyKilledDeck = []; @endphp
                                        @foreach ($allKilledDecks as $killedDeck)
                                            @if (!in_array($killedDeck, $alreadyKilledDeck))
                                            @php $alreadyKilledDeck[] = $killedDeck;@endphp

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$killedDeck[0]->title}} - {{$killedDeck[0]->user->pseudo}}
                                                <span
                                                class="badge bg-info rounded-pill">{{count($killedDeck)}}</span>
                                            </li>       
                                            @else

                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordion2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseThree">
                                    Éliminé par
                                    <span class="badge bg-dark rounded-pill ms-5 alignStatsOnAccordion">
                                        @if ($results_for_deck->count() != 0)
                                            {{ count($totalDeaths) }}
                                        @endif
                                    </span>
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordion2">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        @php $alreadyDeadDeck = []; @endphp
                                        @foreach ($allDeathsDecks as $DeathDeck)
                                            @if (!in_array($DeathDeck, $alreadyDeadDeck))
                                            @php $alreadyDeadDeck[] = $DeathDeck;@endphp

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$DeathDeck[0]->title}} - {{$DeathDeck[0]->user->pseudo}}
                                                <span
                                                class="badge bg-info rounded-pill">{{count($DeathDeck)}}</span>
                                            </li>       
                                            @else

                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Parties jouées
                        <span class="badge bg-info rounded-pill">{{ $results_for_deck->count('*') }}</span>
                    </li>
                </ul>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Victoires
                                <span
                                    class="badge bg-info rounded-pill ms-5 alignStatsOnAccordion">{{ $results_for_deck->where('place', 1)->count('place') }}</span>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        2èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_deck->where('place', 2)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        3èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_deck->where('place', 3)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        4èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_deck->where('place', 4)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        5èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_deck->where('place', 5)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        6èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_deck->where('place', 6)->count('place') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pourcentage de victoire
                            <span class="badge bg-info rounded-pill">
                                @if ($results_for_deck->count('*') != 0)
                                    {{ round(($results_for_deck->where('place', 1)->count('place') / $results_for_deck->count('*')) * 100, 2) }}
                                    %
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Participation
                            <span class="badge bg-info rounded-pill">
                                @if ($totalMatchInChampionship != 0 && $results_for_deck->count('*') != 0)
                                    {{ round(($results_for_deck->count('*') / $totalMatchInChampionship) * 100, 2) }}%
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
