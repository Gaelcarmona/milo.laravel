<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav aria-label="Breadcrumb" class="breadcrumb">
        <ul>
            <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
            <li><a href="{{ route('statistic.championships') }}">Les championnats</a></li>
            <li><span aria-current="page">{{ $championship->title }}</span></li>
        </ul>
    </nav>
    <div>
        <table class="table">
            <thead>
                <th>Nom</th>
                <th>Elo</th>
                <th>Pourcentage de victoire</th>
                <th>Nombre de victoires</th>
                <th>Points par partie</th>
                <th>Kills par partie</th>
                <th>Total de kills</th>
                <th class="d-md-none d-lg-block">Total de morts</th>
                <th>Taux de mortalité</th>
                <th>Total de points</th>
                <th>Matchs joués</th>
            </thead>
            <tbody>
                @foreach ($players as $player)
                    @php
                        $count += 1;
                    @endphp
                    <tr>
                        <td>{{ $player->pseudo }}</td>
                        {{-- $totalMatchInChampionship != 0 && $results_for_player != null --}}
                        @if ($totalMatch != 0 && $results_for_players[$count]->count('*') != 0)
                            <td>{{ round($results_for_players[$count]->where('place', 1)->count('place') +$results_for_players[$count]->pluck('kills')->flatten()->count() +$results_for_players[$count]->where('place', 2)->count('place') / 2 +$results_for_players[$count]->where('place', 3)->count('place') /3 /round(($results_for_players[$count]->count('*') / $totalMatch) * 100, 1),2) }}
                            </td>
                            <td>{{ round(($results_for_players[$count]->where('place', 1)->count('place') / $results_for_players[$count]->count('*')) * 100,2) }}
                                %
                            </td>
                            <td>{{ $results_for_players[$count]->where('place', 1)->count('place') }}</td>
                            <td> {{ round($results_for_players[$count]->avg('score'), 2) }}</td>
                            <td>{{ round($results_for_players[$count]->pluck('kills')->flatten()->count() / $results_for_players[$count]->count(),2) }}
                            </td>
                            <td>{{ $results_for_players[$count]->pluck('kills')->flatten()->count() }}</td>
                            <td class="d-md-none d-lg-block">
                                {{ $championshipResults->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() }}
                            </td>
                            <td>{{ round(($championshipResults->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() /$results_for_players[$count]->count('*')) *100,2) }}
                                %
                            </td>
                            <td>{{ $results_for_players[$count]->sum('score') }}</td>
                            <td>{{ $results_for_players[$count]->count('*') }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                        <table class="table">
                            <thead>
                                <th>Deck</th>
                                <th>Elo</th>
                                <th>Pourcentage de victoire</th>
                                <th>Nombre de victoires</th>
                                <th>Points par partie</th>
                                <th>Kills par partie</th>
                                <th>Total de kills</th>
                                <th>Total de morts</th>
                                <th>Taux de mortalité</th>
                                <th>Total de points</th>
                                <th>Matchs joués</th>
                            </thead>
                            <tbody>
                                @foreach ($decks as $deck)
                                    @php
                                        $countDeck += 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $deck->title }}</td>
                                        @if ($totalMatch != 0 && $results_for_decks[$countDeck]->count('*') != 0)
                                            <td>{{ round($results_for_decks[$countDeck]->where('place', 1)->count('place') +$results_for_decks[$countDeck]->pluck('kills')->flatten()->count() +$results_for_decks[$countDeck]->where('place', 2)->count('place') / 2 +$results_for_decks[$countDeck]->where('place', 3)->count('place') /3 /round(($results_for_decks[$countDeck]->count('*') / $totalMatch) * 100, 1),2) }}
                                            </td>
                                            <td>{{ round(($results_for_decks[$countDeck]->where('place', 1)->count('place') / $results_for_decks[$countDeck]->count('*')) *100,2) }}
                                                %
                                            </td>
                                            <td>{{ $results_for_decks[$countDeck]->where('place', 1)->count('place') }}
                                            </td>
                                            <td> {{ round($results_for_decks[$countDeck]->avg('score'), 2) }}</td>
                                            <td>{{ round($results_for_decks[$countDeck]->pluck('kills')->flatten()->count() / $results_for_decks[$countDeck]->count(),2) }}
                                            </td>
                                            <td>{{ $results_for_decks[$countDeck]->pluck('kills')->flatten()->count() }}
                                            </td>
                                            <td>{{ $championshipResultsDeck->pluck('kills')->flatten()->where('user_killed_id', $deck->user->id)->count() }}
                                            </td>
                                            <td>{{ round(($championshipResultsDeck->pluck('kills')->flatten()->where('user_killed_id', $deck->user->id)->count() /$results_for_decks[$countDeck]->count('*')) *100,2) }}
                                                %
                                            </td>
                                            <td>{{ $results_for_decks[$countDeck]->sum('score') }}</td>
                                            <td>{{ $results_for_decks[$countDeck]->count('*') }}</td>
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
                                    <img src="images/players.jpg" alt="">
                                    <img src="{{ asset('images/small') }}/{{ isset($player->image->url) ? $player->image->url : 'players.jpg' }}"
                                        alt="">
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
                                        alt="">
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
