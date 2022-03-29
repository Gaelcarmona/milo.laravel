@section('title', 'Statistiques de ' . $championship->title)
@section('description', 'Ici on retrouve les statistiques globales de ' . $championship->title . '. On a ici accès aux statistiques des joueurs et des decks pour le championnat en cours')

<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <script src="{{ asset('js/createResults.js') }}"></script>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Statistiques</a></li>
            <li class="breadcrumb-item"><a href="{{ route('statistic.championships') }}">Les championnats</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $championship->title }}</li>
        </ol>
    </nav>
    <div>
        <h2 class="fs-2 text-center">Classement après {{ $totalMatch }} matchs</h2>
        <hr class="mb-3">
        <table id="sortTablePlayerInChampionship" class="table table-sm">
            <thead>
                <tr>
                    <th class="th-sm">Nom</th>
                    <th class="th-sm">Elo</th>
                    <th class="d-none d-md-table-cell th-sm">Pourcentage de victoire</th>
                    <th class="d-none d-md-table-cell th-sm">Nombre de victoires</th>
                    <th class="th-sm">Points par partie</th>
                    <th class="th-sm">Kills par partie</th>
                    <th class="d-none d-lg-table-cell th-sm">Total de kills</th>
                    <th class="d-none d-lg-table-cell th-sm">Total de morts</th>
                    <th class="d-none d-md-table-cell th-sm">Taux de mortalité</th>
                    <th class="th-sm">Total de points</th>
                    <th class="d-none d-md-table-cell th-sm">Matchs joués</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $player)
                    @php
                        $count += 1;
                    @endphp
                    <tr>
                        <td><a class="text-decoration-underline"
                            href="{{ route('statistic.playerInChampionship', [$player->id, $championship->id]) }}">{{ $player->pseudo }}</a>
                        </td>
                        @if ($totalMatch != 0 && $results_for_players[$count]->count('*') != 0)
                        <td>{{ round($results_for_players[$count]->where('place', 1)->count('place') +$results_for_players[$count]->pluck('kills')->flatten()->count() +$results_for_players[$count]->where('place', 2)->count('place') / 2 +$results_for_players[$count]->where('place', 3)->count('place') /3 /round(($results_for_players[$count]->count('*') / $totalMatch) * 100, 1),2) }}
                        </td>
                            <td class="d-none d-md-table-cell">
                                {{ round(($results_for_players[$count]->where('place', 1)->count('place') / $results_for_players[$count]->count('*')) * 100,2) }}
                                %
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $results_for_players[$count]->where('place', 1)->count('place') }}</td>
                                <td> {{ round($results_for_players[$count]->avg('score'), 2) }}</td>
                            <td>{{ round($results_for_players[$count]->pluck('kills')->flatten()->count() / $results_for_players[$count]->count(),2) }}
                            </td>
                            <td class="d-none d-lg-table-cell">
                                {{ $results_for_players[$count]->pluck('kills')->flatten()->count() }}</td>
                                <td class="d-none d-lg-table-cell">
                                    {{ $championshipResults->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() }}
                                </td>
                                <td class="d-none d-md-table-cell">
                                {{ round(($championshipResults->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() /$results_for_players[$count]->count('*')) *100,2) }}
                                %
                            </td>
                            <td>{{ $results_for_players[$count]->sum('score') }}</td>
                            <td class="d-none d-md-table-cell">{{ $results_for_players[$count]->count('*') }}</td>
                            @else
                            <td>0</td>
                            <td class="d-none d-md-table-cell">0</td>
                            <td class="d-none d-md-table-cell">0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="d-none d-lg-table-cell">0</td>
                            <td class="d-none d-lg-table-cell">0</td>
                            <td class="d-none d-md-table-cell">0</td>
                            <td>0</td>
                            <td class="d-none d-md-table-cell">0</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h2 class="fs-2 text-center">Statistiques générales</h2>
                <hr class="mb-3">
            <ul class="list-group mb-2">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Parties jouées
                    <span class="badge bg-info rounded-pill">{{ $totalMatch }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total de meurtres
                    <span class="badge bg-info rounded-pill">{{ $championshipResults->pluck('kills')->flatten()->count() }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Meurtres par partie
                    <span class="badge bg-info rounded-pill">{{ round($championshipResults->pluck('kills')->flatten()->count()/$totalMatch,2)  }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total de points
                    <span class="badge bg-info rounded-pill">{{ $championshipResults->sum('score')}}</span>
                </li>
            </ul>
        </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Classement des decks
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div>
                        <table id="sortTableDeckInChampionship" class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="th-sm">Deck <i class="fa-regular fa-up-down"></i></th>
                                    <th class="th-sm">Elo</th>
                                    <th class="d-none d-md-table-cell th-sm">Pourcentage de victoire</th>
                                    <th class="d-none d-md-table-cell th-sm">Nombre de victoires</th>
                                    <th class="th-sm">Points par partie</th>
                                    <th class="th-sm">Kills par partie</th>
                                    <th class="d-none d-lg-table-cell th-sm">Total de kills</th>
                                    <th>Total de points</th>
                                    <th class="d-none d-md-table-cell th-sm">Matchs joués</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($decks as $deck)
                                    @php
                                        $countDeck += 1;
                                    @endphp
                                    <tr>
                                        <td><a class="text-decoration-underline"
                                                href="{{ route('statistic.deck.in.championship', [$deck->id, $championship->id]) }}">{{ $deck->title }}
                                                - {{ $deck->user->pseudo }}</a></td>
                                        @if ($totalMatch != 0 && $results_for_decks[$countDeck]->count('*') != 0)
                                            <td>{{ round($results_for_decks[$countDeck]->where('place', 1)->count('place') +$results_for_decks[$countDeck]->pluck('kills')->flatten()->count() +$results_for_decks[$countDeck]->where('place', 2)->count('place') / 2 +$results_for_decks[$countDeck]->where('place', 3)->count('place') /3 /round(($results_for_decks[$countDeck]->count('*') / $totalMatch) * 100, 1),2) }}
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                {{ round(($results_for_decks[$countDeck]->where('place', 1)->count('place') / $results_for_decks[$countDeck]->count('*')) *100,2) }}
                                                %
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                {{ $results_for_decks[$countDeck]->where('place', 1)->count('place') }}
                                            </td>
                                            <td> {{ round($results_for_decks[$countDeck]->avg('score'), 2) }}</td>
                                            <td>{{ round($results_for_decks[$countDeck]->pluck('kills')->flatten()->count() / $results_for_decks[$countDeck]->count(),2) }}
                                            </td>
                                            <td class="d-none d-lg-table-cell">
                                                {{ $results_for_decks[$countDeck]->pluck('kills')->flatten()->count() }}
                                            </td>
                                            <td>{{ $results_for_decks[$countDeck]->sum('score') }}</td>
                                            <td class="d-none d-md-table-cell">
                                                {{ $results_for_decks[$countDeck]->count('*') }}</td>
                                        @else
                                            <td>0</td>
                                            <td class="d-none d-md-table-cell">0</td>
                                            <td class="d-none d-md-table-cell">0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="d-none d-lg-table-cell">0</td>
                                            <td>0</td>
                                            <td class="d-none d-md-table-cell">0</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Les joueurs
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($players as $player)
                            {{-- @dd($player) --}}
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img src="images/players.jpg" alt="Image du joueur">
                                    <img src="{{ asset('images/small') }}/{{ isset($player->image->url) ? $player->image->url : 'players.jpg' }}"
                                        alt="Image du joueur">
                                    <div class="card-body">
                                        <p class="card-text">{{ $player->pseudo }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a role="button"
                                                    href="{{ route('statistic.playerInChampionship', [$player->id, $championship->id]) }}"
                                                    class="btn btn-sm btn-outline-secondary">Voir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Les decks
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($decks as $deck)
                            {{-- @dd($deck) --}}
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img src="{{ asset('images/small') }}/{{ isset($deck->image->url) ? $deck->image->url : 'players.jpg' }}"
                                        alt="Image du joueur">
                                    <div class="card-body">
                                        <p class="card-text">{{ $deck->title }}</p>
                                        <p class="card-text">{{ $deck->user->pseudo }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a role="button"
                                                    href="{{ route('statistic.deck.in.championship', [$deck->id, $championship->id]) }}"
                                                    class="btn btn-sm btn-outline-secondary">Voir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
