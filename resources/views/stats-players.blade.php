@section('title', 'Les joueurs')
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Statistiques</a></li>
          <li class="breadcrumb-item active" aria-current="page">Les joueurs</li>
        </ol>
      </nav>
    <div>
        <table id="sortTablePlayer" class="table table-sm">
            <thead>
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

            </thead>
            <tbody>
            @foreach ($players as $player)
                @php
                    $count += 1

                @endphp
                <tr>
                    <td><a href="{{ route('statistic.player', $player->id) }}">{{ $player->pseudo }}</a></td>
                    @if($totalMatch != 0 && $results_for_players[$count]->count('*') != 0)
                        <td>{{ round(($results_for_players[$count]->where('place', 1)->count('place') + $results_for_players[$count]->pluck('kills')->flatten()->count()) + ($results_for_players[$count]->where('place', 2)->count('place') / 2) + ($results_for_players[$count]->where('place', 3)->count('place') / 3) / round(($results_for_players[$count]->count('*') / $totalMatch) * 100, 1),2)}}</td>
                        <td class="d-none d-md-table-cell">{{ round(($results_for_players[$count]->where('place', 1)->count('place') / $results_for_players[$count]->count('*')) * 100, 2) }}
                            %
                        </td>
                        <td class="d-none d-md-table-cell">{{ $results_for_players[$count]->where('place', 1)->count('place') }}</td>
                        <td> {{round($results_for_players[$count]->avg('score'),2) }}</td>
                        <td>{{ round($results_for_players[$count]->pluck('kills')->flatten()->count() / $results_for_players[$count]->count(),2) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $results_for_players[$count]->pluck('kills')->flatten()->count() }}</td>
                        <td class="d-none d-lg-table-cell">{{ $results->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() }}</td>
                        <td class="d-none d-md-table-cell">{{ round($results->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() / $results_for_players[$count]->count('*') * 100, 2) }}
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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($players as $player)
            <div class="col">
                <div class="card shadow-sm">
                    <img
                        src="{{ asset('images/small') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}"
                        alt="">
                    <div class="card-body">
                        <p class="card-text">{{ $player->pseudo }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a role="button" href="{{ route('statistic.player', $player->id) }}"
                                   class="btn btn-sm btn-outline-secondary">Voir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script src="{{ asset('js/createResults.js') }}"></script>
</x-app-layout>
