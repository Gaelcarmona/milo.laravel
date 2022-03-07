<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav aria-label="Breadcrumb" class="breadcrumb">
        <ul>
            <li><a href="{{ route('statistic.home') }}">Statistiques</a></li>
            <li><span aria-current="page">{{ $championship->title }}</span></li>
        </ul>
    </nav>
    <div>
        <table>
            <thead>
            <th>Nom</th>
            <th>Elo</th>
            <th>Pourcentage de victoire</th>
            <th>Nombre de victoires</th>
            <th>Points par partie</th>
            <th>Kills par partie</th>
            <th>Total de kills</th>
            <th>Total de morts</th>
            <th>Taux de mortalité</th>
            <th>Total de points</th>
            </thead>
            <tbody>
            @foreach ($players as $player)
                @php
                    $count += 1

                @endphp
                <tr>
                    <td>{{ $player->pseudo }}</td>
{{--                    $totalMatchInChampionship != 0 && $results_for_player != null--}}
                    @if($totalMatch != 0 && $results_for_players[$count]->count('*') != 0)
                        <td>{{ round(($results_for_players[$count]->where('place', 1)->count('place') + $results_for_players[$count]->pluck('kills')->flatten()->count()) + ($results_for_players[$count]->where('place', 2)->count('place') / 2) + ($results_for_players[$count]->where('place', 3)->count('place') / 3) / round(($results_for_players[$count]->count('*') / $totalMatch) * 100, 1),2)}}</td>
                        <td>{{ round(($results_for_players[$count]->where('place', 1)->count('place') / $results_for_players[$count]->count('*')) * 100, 2) }}
                            %
                        </td>
                        <td>{{ $results_for_players[$count]->where('place', 1)->count('place') }}</td>
                        <td> {{round($results_for_players[$count]->avg('score'),2) }}</td>
                        <td>{{ round($results_for_players[$count]->pluck('kills')->flatten()->count() / $results_for_players[$count]->count(),2) }}</td>
                        <td>{{ $results_for_players[$count]->pluck('kills')->flatten()->count() }}</td>
                        <td>{{ $championshipResults->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() }}</td>
                        <td>{{ round($championshipResults->pluck('kills')->flatten()->where('user_killed_id', $player->id)->count() / $results_for_players[$count]->count('*') * 100, 2) }}
                            %
                        </td>
                        <td>{{ $results_for_players[$count]->sum('score') }}</td>
                    @endif
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($players as $player)
            {{--                @dd($player)--}}
            <div class="col">
                <div class="card shadow-sm">
                    <img src="images/players.jpg" alt="">
                    <img
                        src="{{ asset('images/small') }}/{{ isset($player->image->url) ? $player->image->url  : 'players.jpg' }}"
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
</x-app-layout>
