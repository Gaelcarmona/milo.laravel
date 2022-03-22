@section('title', 'Statistiques de ' . $player->pseudo . ' dans ' . $championship->title)
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
                <li class="breadcrumb-item active" aria-current="page">{{ $player->pseudo }}</li>
            </ol>
        </nav>
        <div class="col-md-6 col-12">

            {{-- <img src="../../images/players.jpg" alt=""> --}}
            <img src="{{ asset('images/large') }}/{{ isset($player->image->url) ? $player->image->url : 'players.jpg' }}"
                alt="">

        </div>
        <div class="col-md-6 col-12">
            <div id="statsPlayer">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total de points
                        <span class="badge bg-primary rounded-pill">
                            @if ($totalMatchInChampionship != 0 && $results_for_player->count('*') != 0)
                                {{ $results_for_player->sum('score') }}
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ELO
                        <span class="badge bg-primary rounded-pill">
                            @if ($totalMatchInChampionship != 0 && $results_for_player->count('*') != 0)
                                {{ round($results_for_player->where('place', 1)->count('place') +$results_for_player->pluck('kills')->flatten()->count() +$results_for_player->where('place', 2)->count('place') / 2 +$results_for_player->where('place', 3)->count('place') /3 /round(($results_for_player->count('*') / $totalMatchInChampionship) * 100, 1),2)  }}
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Score moyen
                        <span
                            class="badge bg-primary rounded-pill">{{ round($results_for_player->avg('score'), 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Place moyenne
                        <span
                            class="badge bg-primary rounded-pill">{{ round($results_for_player->avg('place'), 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taux de mortalité
                        <span class="badge bg-secondary rounded-pill">
                            @if ($results_for_player->count('*') != 0)
                                {{ round(($results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() /$results_for_player->count('*')) *100,2) }}
                                %
                            @endif
                        </span>
                    </li>
                </ul>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Total de morts
                                <span
                                    class="badge bg-secondary rounded-pill ms-5 alignStatsOnAccordion">{{ $results->pluck('kills')->flatten()->where('user_killed_id', $id)->count() }}</span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    @foreach ($Users as $User)
                                        @if ($User->id != $player->id && isset($totalKillsByKiller[$User->id]))
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                Par {{ $User->pseudo }}
                                                <span
                                                    class="badge bg-secondary rounded-pill">{{ $totalKillsByKiller[$User->id] }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Meurtres par partie
                            <span class="badge bg-dark rounded-pill">
                                @if ($results_for_player->count() != 0)
                                    {{ round($results_for_player->pluck('kills')->flatten()->count() / $results_for_player->count(),2) }}
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Place au classement des meurtriers
                            <span class="badge bg-dark rounded-pill">{{ $killRank }}</span>
                        </li>

                    </ul>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Meurtres
                                <span
                                    class="badge bg-dark rounded-pill ms-5 alignStatsOnAccordion">{{ $results_for_player->pluck('kills')->flatten()->count() }}</span>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    @foreach ($results_for_player->pluck('kills')->flatten()->groupBy('user_killed_id')
    as $enemy_id => $kills)
                                        @if ($enemy_id != $player->id)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $kills->first()->user->pseudo }}
                                                <span class="badge bg-dark rounded-pill">{{ $kills->count() }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Parties jouées
                            <span class="badge bg-info rounded-pill">{{ $results_for_player->count('*') }}</span>
                        </li>
                    </ul>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Victoires
                                <span
                                    class="badge bg-info rounded-pill ms-5 alignStatsOnAccordion">{{ $results_for_player->where('place', 1)->count('place') }}</span>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        2èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_player->where('place', 2)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        3èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_player->where('place', 3)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        4èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_player->where('place', 4)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        5èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_player->where('place', 5)->count('place') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        6èmes places
                                        <span
                                            class="badge bg-info rounded-pill">{{ $results_for_player->where('place', 6)->count('place') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pourcentage de victoire
                            <span class="badge bg-info rounded-pill">
                                @if ($results_for_player->count('*') != 0)
                                    {{ round(($results_for_player->where('place', 1)->count('place') / $results_for_player->count('*')) * 100, 2) }}
                                    %
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Participation
                            <span class="badge bg-info rounded-pill">
                                @if ($totalMatchInChampionship != 0 && $results_for_player->count('*') != 0)
                                    {{ round(($results_for_player->count('*') / $totalMatchInChampionship) * 100, 2) }}%
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
