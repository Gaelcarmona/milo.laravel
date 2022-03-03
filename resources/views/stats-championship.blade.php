<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
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
                    <th>Taux de morts par partie</th>
                    <th>Total de points</th>
                </thead>
                <tbody>
                    {{-- @foreach ( as )
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                
                        
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($players as $player)
{{--                @dd($player)--}}
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="images/players.jpg" alt="">
                        <div class="card-body">
                            <p class="card-text">{{ $player->pseudo }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" href="{{ route('statistic.playerInChampionship', [$player->id, $championship->id]) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
</x-app-layout>
