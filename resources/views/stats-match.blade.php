@section('title', $match->title)
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('statistic.home') }}">Statistiques</a></li>
        <li class="breadcrumb-item"><a href="{{ route('statistic.championships') }}">Les championnats</a></li>
        <li class="breadcrumb-item"><a href="{{ route('statistic.championship', $championship->id) }}">{{ $championship->title }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $match->title }}</li>
        </ol>
      </nav>
        <table class='col-12 bg-main table w-100'>
            <thead class='text-white bg-dark'>
            <th class="d-none d-md-table-cell">Place</th>
            <th>Joueur</th>
            <th class="d-none d-md-table-cell">Deck</th>
            <th>a éliminé</th>
            <th>Score</th>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td class="d-none d-md-table-cell">{{$result->place}}</td>
                    <td>{{ $result->user->pseudo }}</td>
                    <td class="d-none d-md-table-cell">{{ $result->deck->title }}</td>
                    <td>
                        @foreach($killed_players as $killed_player)
                            @if($killed_player->result_id == $result->id)
                                {{ $killed_player->user->pseudo }}
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td>{{$result->score}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</x-app-layout>
