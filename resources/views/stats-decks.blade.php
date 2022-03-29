@section('title', 'Les decks')
@section('description', 'Ici on retrouve les statistiques globales des decks')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Statistiques</a></li>
            <li class="breadcrumb-item active" aria-current="page">Les decks</li>
        </ol>
    </nav>
    <div>
        <h2 class="fs-2 text-center">Classement des decks</h2>
        <hr class="mb-3">
        <table id="sortTableDeck" class="table table-sm">
            <thead>
                <tr>
                    <th class="th-sm">Deck</th>
                    <th class="th-sm">Elo</th>
                    <th class="d-none d-md-table-cell th-sm">Pourcentage de victoire</th>
                    <th class="d-none d-md-table-cell th-sm">Nombre de victoires</th>
                    <th class="th-sm">Points par partie</th>
                    <th class="th-sm">Kills par partie</th>
                    <th class="d-none d-lg-table-cell th-sm">Total de kills</th>
                    <th class="th-sm">Total de points</th>
                    <th class="d-none d-md-table-cell th-sm">Matchs joués</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($decks as $deck)
                @php
                    $countDeck += 1;
                @endphp
                <tr>
                    <td><a class="text-decoration-underline" href="{{ route('statistic.deck', $deck->id) }}">{{ $deck->title }} - {{ $deck->user->pseudo }}</a></td>
                    
                    @if ($totalMatch != 0 && $results_for_decks[$countDeck]->count('*') != 0)
                        <td>{{ round($results_for_decks[$countDeck]->where('place', 1)->count('place') +$results_for_decks[$countDeck]->pluck('kills')->flatten()->count() +$results_for_decks[$countDeck]->where('place', 2)->count('place') / 2 +$results_for_decks[$countDeck]->where('place', 3)->count('place') /3 /round(($results_for_decks[$countDeck]->count('*') / $totalMatch) * 100, 1),2) }}
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ round(($results_for_decks[$countDeck]->where('place', 1)->count('place') / $results_for_decks[$countDeck]->count('*')) *100,2) }}
                            %
                        </td>
                        <td class="d-none d-md-table-cell">
                            {{ $results_for_decks[$countDeck]->where('place', 1)->count('place') }}</td>
                        <td> {{ round($results_for_decks[$countDeck]->avg('score'), 2) }}</td>
                        <td>{{ round($results_for_decks[$countDeck]->pluck('kills')->flatten()->count() / $results_for_decks[$countDeck]->count(),2) }}
                        </td>
                        <td class="d-none d-lg-table-cell">
                            {{ $results_for_decks[$countDeck]->pluck('kills')->flatten()->count() }}</td>
                        <td>{{ $results_for_decks[$countDeck]->sum('score') }}
                        </td>
                        <td class="d-none d-md-table-cell">{{ $results_for_decks[$countDeck]->count('*') }}</td>
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
    <div class="accordion accordion-flush" id="accordionFlushExample">
    @foreach ($players as $player)
        @php
            $countUserDecks += 1;
        @endphp
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading{{ $countUserDecks }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{ $countUserDecks }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $countUserDecks }}">
                    Les decks de {{ $player->pseudo }}
                </button>
            </h2>
            <div id="flush-collapse{{ $countUserDecks }}" class="accordion-collapse collapse"
                 aria-labelledby="flush-heading{{ $countUserDecks }}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($usersDecks[$countUserDecks] as $deck)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img
                                        src="{{ asset('images/small') }}/{{ isset($deck->image->url) ? $deck->image->url : 'players.jpg' }}"
                                        alt="Image du deck">
                                    <div class="card-body">
                                        <p class="card-text">{{ $deck->title }}</p>
                                        <p class="card-text">{{ $deck->user->pseudo }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a role="button" href="{{ route('statistic.deck', $deck->id) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
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
    </div>
    <script src="{{ asset('js/createResults.js') }}"></script>
</x-app-layout>
