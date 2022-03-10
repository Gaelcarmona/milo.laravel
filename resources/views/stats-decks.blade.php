<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav aria-label="Breadcrumb" class="breadcrumb">
        <ul>
            <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
            <li><span aria-current="page">Les decks</span></li>
        </ul>
    </nav>
    <div>
        <table class="table">
            <thead>
            <th>Deck</th>
            <th>Elo</th>
            <th class="d-none d-md-table-cell">Pourcentage de victoire</th>
            <th class="d-none d-md-table-cell">Nombre de victoires</th>
            <th>Points par partie</th>
            <th>Kills par partie</th>
            <th class="d-none d-lg-table-cell">Total de kills</th>
            <th class="d-none d-lg-table-cell">Total de morts</th>
            <th>Taux de mortalité</th>
            <th class="d-none d-md-table-cell">Total de points</th>
            <th class="d-none d-md-table-cell">Matchs joués</th>
            </thead>
            <tbody>
            @foreach ($decks as $deck)
                @php
                    $countDeck += 1
                @endphp
                {{--                @dd($championshipResultsDeck)--}}
                <tr>
                    <td>{{ $deck->title }}</td>
                    @if($totalMatch != 0 && $results_for_decks[$countDeck]->count('*') != 0)
                        <td>{{ round(($results_for_decks[$countDeck]->where('place', 1)->count('place') + $results_for_decks[$countDeck]->pluck('kills')->flatten()->count()) + ($results_for_decks[$countDeck]->where('place', 2)->count('place') / 2) + ($results_for_decks[$countDeck]->where('place', 3)->count('place') / 3) / round(($results_for_decks[$countDeck]->count('*') / $totalMatch) * 100, 1),2)}}</td>
                        <td class="d-none d-md-table-cell">{{ round(($results_for_decks[$countDeck]->where('place', 1)->count('place') / $results_for_decks[$countDeck]->count('*')) * 100, 2) }}
                            %
                        </td>
                        <td class="d-none d-md-table-cell">{{ $results_for_decks[$countDeck]->where('place', 1)->count('place') }}</td>
                        <td> {{round($results_for_decks[$countDeck]->avg('score'),2) }}</td>
                        <td>{{ round($results_for_decks[$countDeck]->pluck('kills')->flatten()->count() / $results_for_decks[$countDeck]->count(),2) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $results_for_decks[$countDeck]->pluck('kills')->flatten()->count() }}</td>
                        <td class="d-none d-lg-table-cell">{{ $championshipResultsDeck->pluck('kills')->flatten()->where('user_killed_id', $deck->user->id)->count() }}</td>
                        <td>{{ round($championshipResultsDeck->pluck('kills')->flatten()->where('user_killed_id', $deck->user->id)->count() / $results_for_decks[$countDeck]->count('*') * 100, 2) }}
                            %
                        </td>
                        <td class="d-none d-md-table-cell">{{ $results_for_decks[$countDeck]->sum('score') }}</td>
                        <td class="d-none d-md-table-cell">{{ $results_for_decks[$countDeck]->count('*') }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @foreach($players as $player)
        @php
        $countUserDecks += 1
        @endphp
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading{{$countUserDecks}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapse{{$countUserDecks}}" aria-expanded="false" aria-controls="flush-collapse{{$countUserDecks}}">
                Les decks de {{ $player->pseudo }}
            </button>
        </h2>
        <div id="flush-collapse{{$countUserDecks}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$countUserDecks}}"
             data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($usersDecks[$countUserDecks] as $deck)
                        {{-- @dd($deck) --}}
                        <div class="col">
                            <div class="card shadow-sm">
                                <img
                                    src="{{ asset('images/small') }}/{{ isset($deck->image->url) ? $deck->image->url : 'players.jpg' }}"
                                    alt="">
                                <div class="card-body">
                                    <p class="card-text">{{ $deck->title }}</p>
                                    <p class="card-text">{{ $deck->user->pseudo }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a role="button"
                                            <a role="button" href="{{ route('statistic.deck', $deck->id) }}"
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
    @endforeach

</x-app-layout>
